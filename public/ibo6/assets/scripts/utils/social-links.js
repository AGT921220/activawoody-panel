(function createSocialShares() {
  var socialsContainers = document.querySelectorAll("div.social-links");

  var socials = [
    {
      name: "twitter",
      icon: "twitter",
      sharer: "https://twitter.com/intent/tweet?url="
    },
    {
      name: "facebook",
      icon: "facebook",
      sharer: "https://www.facebook.com/sharer.php?u="
    },
    {
      name: "pinterest",
      icon: "pinterest",
      sharer: "https://pinterest.com/pin/create/button/?url="
    },
    {
      name: "linkedin",
      icon: "linkedin2",
      sharer: "https://www.linkedin.com/shareArticle?url="
    },
  ];

  for (var x = 0; x < socials.length; x++) {
    var social = socials[x];

    var name = social.name;
    var icon = social.icon;
    var sharer = social.sharer;

    for (var i = 0; i < socialsContainers.length; i++) {
      var container = socialsContainers[i];
      container.innerHTML +=
        '<a href="' +
        sharer+encodeURIComponent(window.location.href) +
        '" data-name="' +
        name +
        '" rel="nofollow" title="Share on ' +
        name +
        '" target="_blank"><span class="icon-' +
        icon +
        '"></span></a>';
    }
  }
})();
