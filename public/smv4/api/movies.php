<?php
// Connect to the SQLite database
$db = new SQLite3('./.bet_tmdb.db');

// Query to retrieve the API key from the 'api_key' table
$query = "SELECT key FROM api_key LIMIT 1";
$result = $db->querySingle($query);

// Close the database connection
$db->close();

// Check if the API key was retrieved successfully
if ($result) {
    $api_key = $result;
} 
// Common API parameters
$language = "en-US";

// Define the cache folder and file path
$cache_folder = 'cache/';
$cache_file = $cache_folder . 'combined_cache.json';

// Create the cache folder if it doesn't exist
if (!file_exists($cache_folder)) {
    mkdir($cache_folder, 0777, true);
}

// Cache validity duration (12 hours in seconds)
$cache_duration = 12 * 60 * 60;

// Check if cached data is still valid
if (file_exists($cache_file) && time() - filemtime($cache_file) < $cache_duration) {
    // Use cached data
    $cached_data = file_get_contents($cache_file);
    $combined_data = json_decode($cached_data, true);
} else {
    // Fetch movies data using cURL
    $movies_url = "https://api.themoviedb.org/3/trending/movie/week?api_key=$api_key&language=$language";
    $movies_curl = curl_init($movies_url);
    curl_setopt($movies_curl, CURLOPT_RETURNTRANSFER, true);
    $movies_response = curl_exec($movies_curl);
    curl_close($movies_curl);

    $movies_data = json_decode($movies_response, true);

    // Fetch shows data using cURL
    $shows_url = "https://api.themoviedb.org/3/trending/tv/week?api_key=$api_key&language=$language";
    $shows_curl = curl_init($shows_url);
    curl_setopt($shows_curl, CURLOPT_RETURNTRANSFER, true);
    $shows_response = curl_exec($shows_curl);
    curl_close($shows_curl);

    $shows_data = json_decode($shows_response, true);

    // Initialize combined data array
    $combined_data = [];

    // Alternate between adding one record from movies and one from shows
    $numMovies = count($movies_data['results']);
    $numShows = count($shows_data['results']);
    $maxCount = max($numMovies, $numShows);

    for ($i = 0; $i < $maxCount; $i++) {
        if ($i < $numMovies) {
            $movie = $movies_data['results'][$i];
            $backdrop_path = 'https://image.tmdb.org/t/p/original' . $movie['backdrop_path'];
            $poster_path = 'https://image.tmdb.org/t/p/original' . $movie['poster_path'];
            $title = $movie['title'];
            $subtitle = $movie['overview'];
            $url = 'https://www.themoviedb.org/movie/' . $movie['id'];

            $combined_data[] = array(
                "image" => $backdrop_path,
                "artWork" => $poster_path,
                "title" => $title,
                "subtitle" => $subtitle,
                "url" => $url
            );
        }

        if ($i < $numShows) {
            $show = $shows_data['results'][$i];
            $backdrop_path = 'https://image.tmdb.org/t/p/original' . $show['backdrop_path'];
            $poster_path = 'https://image.tmdb.org/t/p/original' . $show['poster_path'];
            $title = $show['name'];
            $subtitle = $show['overview'];
            $url = 'https://www.themoviedb.org/movie/' . $show['id'];

            $combined_data[] = array(
                "image" => $backdrop_path,
                "artWork" => $poster_path,
                "title" => $title,
                "subtitle" => $subtitle,
                "url" => $url
            );
        }
    }

    // Encode and store the combined data in the cache file without escaping slashes
    $encoded_data = json_encode($combined_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($cache_file, $encoded_data);
}

// Set the appropriate header and echo the combined data as JSON
header("Content-Type: application/json");
echo json_encode($combined_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
