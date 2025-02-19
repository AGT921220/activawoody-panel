<div class="row mb-4">
	<div class="col-lg-12 col-md-12 mb-md-0">
		<div class="card">
			<div class="card-header pb-0">
				<div class="row">
					<div class="col-lg-6 col-7">
						<h6>Manage VPN</h6>
					</div>
					<?php
					$activeChecked = "";
					if ($vpnEditInfo['active'] == "1") {
						$activeChecked = "checked";
					}
					$authChecked = "";
					if ($vpnEditInfo['auth_embedded'] == "1") {
						$authChecked = "checked";
					}

					?>
				</div>
			</div>
			<div class="card-body px-0 pb-2">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-12">
							<div class="card card-plain">
								<div class="card-body">
									<form action="action.php" method="post" role="form" enctype="multipart/form-data">
										<input name="id" type="hidden" value="<?php echo $vpnEditInfo['id'] ?>" />
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Location</label>

											<input name="location" type="text" class="form-control" value="<?php echo $vpnEditInfo['location']; ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Country</label>
											<select class="select form-control" id="select" name="country">
												<option value="AF" <?= $vpnEditInfo['country'] == 'AF' ? 'selected' : '' ?>>Afghanistan</option>
												<option value="AX" <?= $vpnEditInfo['country'] == 'AX' ? 'selected' : '' ?>>Åland Islands</option>
												<option value="AL" <?= $vpnEditInfo['country'] == 'AL' ? 'selected' : '' ?>>Albania</option>
												<option value="DZ" <?= $vpnEditInfo['country'] == 'DZ' ? 'selected' : '' ?>>Algeria</option>
												<option value="AS" <?= $vpnEditInfo['country'] == 'AS' ? 'selected' : '' ?>>American Samoa</option>
												<option value="AD" <?= $vpnEditInfo['country'] == 'AD' ? 'selected' : '' ?>>Andorra</option>
												<option value="AO" <?= $vpnEditInfo['country'] == 'AO' ? 'selected' : '' ?>>Angola</option>
												<option value="AI" <?= $vpnEditInfo['country'] == 'AI' ? 'selected' : '' ?>>Anguilla</option>
												<option value="AQ" <?= $vpnEditInfo['country'] == 'AQ' ? 'selected' : '' ?>>Antarctica</option>
												<option value="AG" <?= $vpnEditInfo['country'] == 'AG' ? 'selected' : '' ?>>Antigua and Barbuda</option>
												<option value="AR" <?= $vpnEditInfo['country'] == 'AR' ? 'selected' : '' ?>>Argentina</option>
												<option value="AM" <?= $vpnEditInfo['country'] == 'AM' ? 'selected' : '' ?>>Armenia</option>
												<option value="AW" <?= $vpnEditInfo['country'] == 'AW' ? 'selected' : '' ?>>Aruba</option>
												<option value="AU" <?= $vpnEditInfo['country'] == 'AU' ? 'selected' : '' ?>>Australia</option>
												<option value="AT" <?= $vpnEditInfo['country'] == 'AT' ? 'selected' : '' ?>>Austria</option>
												<option value="AZ" <?= $vpnEditInfo['country'] == 'AZ' ? 'selected' : '' ?>>Azerbaijan</option>
												<option value="BS" <?= $vpnEditInfo['country'] == 'BS' ? 'selected' : '' ?>>Bahamas</option>
												<option value="BH" <?= $vpnEditInfo['country'] == 'BH' ? 'selected' : '' ?>>Bahrain</option>
												<option value="BD" <?= $vpnEditInfo['country'] == 'BD' ? 'selected' : '' ?>>Bangladesh</option>
												<option value="BB" <?= $vpnEditInfo['country'] == 'BB' ? 'selected' : '' ?>>Barbados</option>
												<option value="BY" <?= $vpnEditInfo['country'] == 'BY' ? 'selected' : '' ?>>Belarus</option>
												<option value="BE" <?= $vpnEditInfo['country'] == 'BE' ? 'selected' : '' ?>>Belgium</option>
												<option value="BZ" <?= $vpnEditInfo['country'] == 'BZ' ? 'selected' : '' ?>>Belize</option>
												<option value="BJ" <?= $vpnEditInfo['country'] == 'BJ' ? 'selected' : '' ?>>Benin</option>
												<option value="BM" <?= $vpnEditInfo['country'] == 'BM' ? 'selected' : '' ?>>Bermuda</option>
												<option value="BT" <?= $vpnEditInfo['country'] == 'BT' ? 'selected' : '' ?>>Bhutan</option>
												<option value="BO" <?= $vpnEditInfo['country'] == 'BO' ? 'selected' : '' ?>>Bolivia, Plurinational State of</option>
												<option value="BQ" <?= $vpnEditInfo['country'] == 'BQ' ? 'selected' : '' ?>>Bonaire, Sint Eustatius and Saba</option>
												<option value="BA" <?= $vpnEditInfo['country'] == 'BA' ? 'selected' : '' ?>>Bosnia and Herzegovina</option>
												<option value="BW" <?= $vpnEditInfo['country'] == 'BW' ? 'selected' : '' ?>>Botswana</option>
												<option value="BV" <?= $vpnEditInfo['country'] == 'BV' ? 'selected' : '' ?>>Bouvet Island</option>
												<option value="BR" <?= $vpnEditInfo['country'] == 'BR' ? 'selected' : '' ?>>Brazil</option>
												<option value="IO" <?= $vpnEditInfo['country'] == 'IO' ? 'selected' : '' ?>>British Indian Ocean Territory</option>
												<option value="BN" <?= $vpnEditInfo['country'] == 'BN' ? 'selected' : '' ?>>Brunei Darussalam</option>
												<option value="BG" <?= $vpnEditInfo['country'] == 'BG' ? 'selected' : '' ?>>Bulgaria</option>
												<option value="BF" <?= $vpnEditInfo['country'] == 'BF' ? 'selected' : '' ?>>Burkina Faso</option>
												<option value="BI" <?= $vpnEditInfo['country'] == 'BI' ? 'selected' : '' ?>>Burundi</option>
												<option value="KH" <?= $vpnEditInfo['country'] == 'KH' ? 'selected' : '' ?>>Cambodia</option>
												<option value="CM" <?= $vpnEditInfo['country'] == 'CM' ? 'selected' : '' ?>>Cameroon</option>
												<option value="CA" <?= $vpnEditInfo['country'] == 'CA' ? 'selected' : '' ?>>Canada</option>
												<option value="CV" <?= $vpnEditInfo['country'] == 'CV' ? 'selected' : '' ?>>Cape Verde</option>
												<option value="KY" <?= $vpnEditInfo['country'] == 'KY' ? 'selected' : '' ?>>Cayman Islands</option>
												<option value="CF" <?= $vpnEditInfo['country'] == 'CF' ? 'selected' : '' ?>>Central African Republic</option>
												<option value="TD" <?= $vpnEditInfo['country'] == 'TD' ? 'selected' : '' ?>>Chad</option>
												<option value="CL" <?= $vpnEditInfo['country'] == 'CL' ? 'selected' : '' ?>>Chile</option>
												<option value="CN" <?= $vpnEditInfo['country'] == 'CN' ? 'selected' : '' ?>>China</option>
												<option value="CX" <?= $vpnEditInfo['country'] == 'CX' ? 'selected' : '' ?>>Christmas Island</option>
												<option value="CC" <?= $vpnEditInfo['country'] == 'CC' ? 'selected' : '' ?>>Cocos (Keeling) Islands</option>
												<option value="CO" <?= $vpnEditInfo['country'] == 'CO' ? 'selected' : '' ?>>Colombia</option>
												<option value="KM" <?= $vpnEditInfo['country'] == 'KM' ? 'selected' : '' ?>>Comoros</option>
												<option value="CG" <?= $vpnEditInfo['country'] == 'CG' ? 'selected' : '' ?>>Congo</option>
												<option value="CD" <?= $vpnEditInfo['country'] == 'CD' ? 'selected' : '' ?>>Congo, the Democratic Republic of the</option>
												<option value="CK" <?= $vpnEditInfo['country'] == 'CK' ? 'selected' : '' ?>>Cook Islands</option>
												<option value="CR" <?= $vpnEditInfo['country'] == 'CR' ? 'selected' : '' ?>>Costa Rica</option>
												<option value="CI" <?= $vpnEditInfo['country'] == 'CI' ? 'selected' : '' ?>>Côte d'Ivoire</option>
												<option value="HR" <?= $vpnEditInfo['country'] == 'HR' ? 'selected' : '' ?>>Croatia</option>
												<option value="CU" <?= $vpnEditInfo['country'] == 'CU' ? 'selected' : '' ?>>Cuba</option>
												<option value="CW" <?= $vpnEditInfo['country'] == 'CW' ? 'selected' : '' ?>>Curaçao</option>
												<option value="CY" <?= $vpnEditInfo['country'] == 'CY' ? 'selected' : '' ?>>Cyprus</option>
												<option value="CZ" <?= $vpnEditInfo['country'] == 'CZ' ? 'selected' : '' ?>>Czech Republic</option>
												<option value="DK" <?= $vpnEditInfo['country'] == 'DK' ? 'selected' : '' ?>>Denmark</option>
												<option value="DJ" <?= $vpnEditInfo['country'] == 'DJ' ? 'selected' : '' ?>>Djibouti</option>
												<option value="DM" <?= $vpnEditInfo['country'] == 'DM' ? 'selected' : '' ?>>Dominica</option>
												<option value="DO" <?= $vpnEditInfo['country'] == 'DO' ? 'selected' : '' ?>>Dominican Republic</option>
												<option value="EC" <?= $vpnEditInfo['country'] == 'EC' ? 'selected' : '' ?>>Ecuador</option>
												<option value="EG" <?= $vpnEditInfo['country'] == 'EG' ? 'selected' : '' ?>>Egypt</option>
												<option value="SV" <?= $vpnEditInfo['country'] == 'SV' ? 'selected' : '' ?>>El Salvador</option>
												<option value="GQ" <?= $vpnEditInfo['country'] == 'GQ' ? 'selected' : '' ?>>Equatorial Guinea</option>
												<option value="ER" <?= $vpnEditInfo['country'] == 'ER' ? 'selected' : '' ?>>Eritrea</option>
												<option value="EE" <?= $vpnEditInfo['country'] == 'EE' ? 'selected' : '' ?>>Estonia</option>
												<option value="ET" <?= $vpnEditInfo['country'] == 'ET' ? 'selected' : '' ?>>Ethiopia</option>
												<option value="FK" <?= $vpnEditInfo['country'] == 'FK' ? 'selected' : '' ?>>Falkland Islands (Malvinas)</option>
												<option value="FO" <?= $vpnEditInfo['country'] == 'FO' ? 'selected' : '' ?>>Faroe Islands</option>
												<option value="FJ" <?= $vpnEditInfo['country'] == 'FJ' ? 'selected' : '' ?>>Fiji</option>
												<option value="FI" <?= $vpnEditInfo['country'] == 'FI' ? 'selected' : '' ?>>Finland</option>
												<option value="FR" <?= $vpnEditInfo['country'] == 'FR' ? 'selected' : '' ?>>France</option>
												<option value="GF" <?= $vpnEditInfo['country'] == 'GF' ? 'selected' : '' ?>>French Guiana</option>
												<option value="PF" <?= $vpnEditInfo['country'] == 'PF' ? 'selected' : '' ?>>French Polynesia</option>
												<option value="TF" <?= $vpnEditInfo['country'] == 'TF' ? 'selected' : '' ?>>French Southern Territories</option>
												<option value="GA" <?= $vpnEditInfo['country'] == 'GA' ? 'selected' : '' ?>>Gabon</option>
												<option value="GM" <?= $vpnEditInfo['country'] == 'GM' ? 'selected' : '' ?>>Gambia</option>
												<option value="GE" <?= $vpnEditInfo['country'] == 'GE' ? 'selected' : '' ?>>Georgia</option>
												<option value="DE" <?= $vpnEditInfo['country'] == 'DE' ? 'selected' : '' ?>>Germany</option>
												<option value="GH" <?= $vpnEditInfo['country'] == 'GH' ? 'selected' : '' ?>>Ghana</option>
												<option value="GI" <?= $vpnEditInfo['country'] == 'GI' ? 'selected' : '' ?>>Gibraltar</option>
												<option value="GR" <?= $vpnEditInfo['country'] == 'GR' ? 'selected' : '' ?>>Greece</option>
												<option value="GL" <?= $vpnEditInfo['country'] == 'GL' ? 'selected' : '' ?>>Greenland</option>
												<option value="GD" <?= $vpnEditInfo['country'] == 'GD' ? 'selected' : '' ?>>Grenada</option>
												<option value="GP" <?= $vpnEditInfo['country'] == 'GP' ? 'selected' : '' ?>>Guadeloupe</option>
												<option value="GU" <?= $vpnEditInfo['country'] == 'GU' ? 'selected' : '' ?>>Guam</option>
												<option value="GT" <?= $vpnEditInfo['country'] == 'GT' ? 'selected' : '' ?>>Guatemala</option>
												<option value="GG" <?= $vpnEditInfo['country'] == 'GG' ? 'selected' : '' ?>>Guernsey</option>
												<option value="GN" <?= $vpnEditInfo['country'] == 'GN' ? 'selected' : '' ?>>Guinea</option>
												<option value="GW" <?= $vpnEditInfo['country'] == 'GW' ? 'selected' : '' ?>>Guinea-Bissau</option>
												<option value="GY" <?= $vpnEditInfo['country'] == 'GY' ? 'selected' : '' ?>>Guyana</option>
												<option value="HT" <?= $vpnEditInfo['country'] == 'HT' ? 'selected' : '' ?>>Haiti</option>
												<option value="HM" <?= $vpnEditInfo['country'] == 'HM' ? 'selected' : '' ?>>Heard Island and McDonald Islands</option>
												<option value="VA" <?= $vpnEditInfo['country'] == 'VA' ? 'selected' : '' ?>>Holy See (Vatican City State)</option>
												<option value="HN" <?= $vpnEditInfo['country'] == 'HN' ? 'selected' : '' ?>>Honduras</option>
												<option value="HK" <?= $vpnEditInfo['country'] == 'HK' ? 'selected' : '' ?>>Hong Kong</option>
												<option value="HU" <?= $vpnEditInfo['country'] == 'HU' ? 'selected' : '' ?>>Hungary</option>
												<option value="IS" <?= $vpnEditInfo['country'] == 'IS' ? 'selected' : '' ?>>Iceland</option>
												<option value="IN" <?= $vpnEditInfo['country'] == 'IN' ? 'selected' : '' ?>>India</option>
												<option value="ID" <?= $vpnEditInfo['country'] == 'ID' ? 'selected' : '' ?>>Indonesia</option>
												<option value="IR" <?= $vpnEditInfo['country'] == 'IR' ? 'selected' : '' ?>>Iran, Islamic Republic of</option>
												<option value="IQ" <?= $vpnEditInfo['country'] == 'IQ' ? 'selected' : '' ?>>Iraq</option>
												<option value="IE" <?= $vpnEditInfo['country'] == 'IE' ? 'selected' : '' ?>>Ireland</option>
												<option value="IM" <?= $vpnEditInfo['country'] == 'IM' ? 'selected' : '' ?>>Isle of Man</option>
												<option value="IL" <?= $vpnEditInfo['country'] == 'IL' ? 'selected' : '' ?>>Israel</option>
												<option value="IT" <?= $vpnEditInfo['country'] == 'IT' ? 'selected' : '' ?>>Italy</option>
												<option value="JM" <?= $vpnEditInfo['country'] == 'JM' ? 'selected' : '' ?>>Jamaica</option>
												<option value="JP" <?= $vpnEditInfo['country'] == 'JP' ? 'selected' : '' ?>>Japan</option>
												<option value="JE" <?= $vpnEditInfo['country'] == 'JE' ? 'selected' : '' ?>>Jersey</option>
												<option value="JO" <?= $vpnEditInfo['country'] == 'JO' ? 'selected' : '' ?>>Jordan</option>
												<option value="KZ" <?= $vpnEditInfo['country'] == 'KZ' ? 'selected' : '' ?>>Kazakhstan</option>
												<option value="KE" <?= $vpnEditInfo['country'] == 'KE' ? 'selected' : '' ?>>Kenya</option>
												<option value="KI" <?= $vpnEditInfo['country'] == 'KI' ? 'selected' : '' ?>>Kiribati</option>
												<option value="KP" <?= $vpnEditInfo['country'] == 'KP' ? 'selected' : '' ?>>Korea, Democratic People's Republic of</option>
												<option value="KR" <?= $vpnEditInfo['country'] == 'KR' ? 'selected' : '' ?>>Korea, Republic of</option>
												<option value="KW" <?= $vpnEditInfo['country'] == 'KW' ? 'selected' : '' ?>>Kuwait</option>
												<option value="KG" <?= $vpnEditInfo['country'] == 'KG' ? 'selected' : '' ?>>Kyrgyzstan</option>
												<option value="LA" <?= $vpnEditInfo['country'] == 'LA' ? 'selected' : '' ?>>Lao People's Democratic Republic</option>
												<option value="LV" <?= $vpnEditInfo['country'] == 'LV' ? 'selected' : '' ?>>Latvia</option>
												<option value="LB" <?= $vpnEditInfo['country'] == 'LB' ? 'selected' : '' ?>>Lebanon</option>
												<option value="LS" <?= $vpnEditInfo['country'] == 'LS' ? 'selected' : '' ?>>Lesotho</option>
												<option value="LR" <?= $vpnEditInfo['country'] == 'LR' ? 'selected' : '' ?>>Liberia</option>
												<option value="LY" <?= $vpnEditInfo['country'] == 'LY' ? 'selected' : '' ?>>Libya</option>
												<option value="LI" <?= $vpnEditInfo['country'] == 'LI' ? 'selected' : '' ?>>Liechtenstein</option>
												<option value="LT" <?= $vpnEditInfo['country'] == 'LT' ? 'selected' : '' ?>>Lithuania</option>
												<option value="LU" <?= $vpnEditInfo['country'] == 'LU' ? 'selected' : '' ?>>Luxembourg</option>
												<option value="MO" <?= $vpnEditInfo['country'] == 'MO' ? 'selected' : '' ?>>Macao</option>
												<option value="MK" <?= $vpnEditInfo['country'] == 'MK' ? 'selected' : '' ?>>Macedonia, the former Yugoslav Republic of</option>
												<option value="MG" <?= $vpnEditInfo['country'] == 'MG' ? 'selected' : '' ?>>Madagascar</option>
												<option value="MW" <?= $vpnEditInfo['country'] == 'MW' ? 'selected' : '' ?>>Malawi</option>
												<option value="MY" <?= $vpnEditInfo['country'] == 'MY' ? 'selected' : '' ?>>Malaysia</option>
												<option value="MV" <?= $vpnEditInfo['country'] == 'MV' ? 'selected' : '' ?>>Maldives</option>
												<option value="ML" <?= $vpnEditInfo['country'] == 'ML' ? 'selected' : '' ?>>Mali</option>
												<option value="MT" <?= $vpnEditInfo['country'] == 'MT' ? 'selected' : '' ?>>Malta</option>
												<option value="MH" <?= $vpnEditInfo['country'] == 'MH' ? 'selected' : '' ?>>Marshall Islands</option>
												<option value="MQ" <?= $vpnEditInfo['country'] == 'MQ' ? 'selected' : '' ?>>Martinique</option>
												<option value="MR" <?= $vpnEditInfo['country'] == 'MR' ? 'selected' : '' ?>>Mauritania</option>
												<option value="MU" <?= $vpnEditInfo['country'] == 'MU' ? 'selected' : '' ?>>Mauritius</option>
												<option value="YT" <?= $vpnEditInfo['country'] == 'YT' ? 'selected' : '' ?>>Mayotte</option>
												<option value="MX" <?= $vpnEditInfo['country'] == 'MX' ? 'selected' : '' ?>>Mexico</option>
												<option value="FM" <?= $vpnEditInfo['country'] == 'FM' ? 'selected' : '' ?>>Micronesia, Federated States of</option>
												<option value="MD" <?= $vpnEditInfo['country'] == 'MD' ? 'selected' : '' ?>>Moldova, Republic of</option>
												<option value="MC" <?= $vpnEditInfo['country'] == 'MC' ? 'selected' : '' ?>>Monaco</option>
												<option value="MN" <?= $vpnEditInfo['country'] == 'MN' ? 'selected' : '' ?>>Mongolia</option>
												<option value="ME" <?= $vpnEditInfo['country'] == 'ME' ? 'selected' : '' ?>>Montenegro</option>
												<option value="MS" <?= $vpnEditInfo['country'] == 'MS' ? 'selected' : '' ?>>Montserrat</option>
												<option value="MA" <?= $vpnEditInfo['country'] == 'MA' ? 'selected' : '' ?>>Morocco</option>
												<option value="MZ" <?= $vpnEditInfo['country'] == 'MZ' ? 'selected' : '' ?>>Mozambique</option>
												<option value="MM" <?= $vpnEditInfo['country'] == 'MM' ? 'selected' : '' ?>>Myanmar</option>
												<option value="NA" <?= $vpnEditInfo['country'] == 'NA' ? 'selected' : '' ?>>Namibia</option>
												<option value="NR" <?= $vpnEditInfo['country'] == 'NR' ? 'selected' : '' ?>>Nauru</option>
												<option value="NP" <?= $vpnEditInfo['country'] == 'NP' ? 'selected' : '' ?>>Nepal</option>
												<option value="NL" <?= $vpnEditInfo['country'] == 'NL' ? 'selected' : '' ?>>Netherlands</option>
												<option value="NC" <?= $vpnEditInfo['country'] == 'NC' ? 'selected' : '' ?>>New Caledonia</option>
												<option value="NZ" <?= $vpnEditInfo['country'] == 'NZ' ? 'selected' : '' ?>>New Zealand</option>
												<option value="NI" <?= $vpnEditInfo['country'] == 'NI' ? 'selected' : '' ?>>Nicaragua</option>
												<option value="NE" <?= $vpnEditInfo['country'] == 'NE' ? 'selected' : '' ?>>Niger</option>
												<option value="NG" <?= $vpnEditInfo['country'] == 'NG' ? 'selected' : '' ?>>Nigeria</option>
												<option value="NU" <?= $vpnEditInfo['country'] == 'NU' ? 'selected' : '' ?>>Niue</option>
												<option value="NF" <?= $vpnEditInfo['country'] == 'NF' ? 'selected' : '' ?>>Norfolk Island</option>
												<option value="MP" <?= $vpnEditInfo['country'] == 'MP' ? 'selected' : '' ?>>Northern Mariana Islands</option>
												<option value="NO" <?= $vpnEditInfo['country'] == 'NO' ? 'selected' : '' ?>>Norway</option>
												<option value="OM" <?= $vpnEditInfo['country'] == 'OM' ? 'selected' : '' ?>>Oman</option>
												<option value="PK" <?= $vpnEditInfo['country'] == 'PK' ? 'selected' : '' ?>>Pakistan</option>
												<option value="PW" <?= $vpnEditInfo['country'] == 'PW' ? 'selected' : '' ?>>Palau</option>
												<option value="PS" <?= $vpnEditInfo['country'] == 'PS' ? 'selected' : '' ?>>Palestinian Territory, Occupied</option>
												<option value="PA" <?= $vpnEditInfo['country'] == 'PA' ? 'selected' : '' ?>>Panama</option>
												<option value="PG" <?= $vpnEditInfo['country'] == 'PG' ? 'selected' : '' ?>>Papua New Guinea</option>
												<option value="PY" <?= $vpnEditInfo['country'] == 'PY' ? 'selected' : '' ?>>Paraguay</option>
												<option value="PE" <?= $vpnEditInfo['country'] == 'PE' ? 'selected' : '' ?>>Peru</option>
												<option value="PH" <?= $vpnEditInfo['country'] == 'PH' ? 'selected' : '' ?>>Philippines</option>
												<option value="PN" <?= $vpnEditInfo['country'] == 'PN' ? 'selected' : '' ?>>Pitcairn</option>
												<option value="PL" <?= $vpnEditInfo['country'] == 'PL' ? 'selected' : '' ?>>Poland</option>
												<option value="PT" <?= $vpnEditInfo['country'] == 'PT' ? 'selected' : '' ?>>Portugal</option>
												<option value="PR" <?= $vpnEditInfo['country'] == 'PR' ? 'selected' : '' ?>>Puerto Rico</option>
												<option value="QA" <?= $vpnEditInfo['country'] == 'QA' ? 'selected' : '' ?>>Qatar</option>
												<option value="RE" <?= $vpnEditInfo['country'] == 'RE' ? 'selected' : '' ?>>Réunion</option>
												<option value="RO" <?= $vpnEditInfo['country'] == 'RO' ? 'selected' : '' ?>>Romania</option>
												<option value="RU" <?= $vpnEditInfo['country'] == 'RU' ? 'selected' : '' ?>>Russian Federation</option>
												<option value="RW" <?= $vpnEditInfo['country'] == 'RW' ? 'selected' : '' ?>>Rwanda</option>
												<option value="BL" <?= $vpnEditInfo['country'] == 'BL' ? 'selected' : '' ?>>Saint Barthélemy</option>
												<option value="SH" <?= $vpnEditInfo['country'] == 'SH' ? 'selected' : '' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
												<option value="KN" <?= $vpnEditInfo['country'] == 'KN' ? 'selected' : '' ?>>Saint Kitts and Nevis</option>
												<option value="LC" <?= $vpnEditInfo['country'] == 'LC' ? 'selected' : '' ?>>Saint Lucia</option>
												<option value="MF" <?= $vpnEditInfo['country'] == 'MF' ? 'selected' : '' ?>>Saint Martin (French part)</option>
												<option value="PM" <?= $vpnEditInfo['country'] == 'PM' ? 'selected' : '' ?>>Saint Pierre and Miquelon</option>
												<option value="VC" <?= $vpnEditInfo['country'] == 'VC' ? 'selected' : '' ?>>Saint Vincent and the Grenadines</option>
												<option value="WS" <?= $vpnEditInfo['country'] == 'WS' ? 'selected' : '' ?>>Samoa</option>
												<option value="SM" <?= $vpnEditInfo['country'] == 'SM' ? 'selected' : '' ?>>San Marino</option>
												<option value="ST" <?= $vpnEditInfo['country'] == 'ST' ? 'selected' : '' ?>>Sao Tome and Principe</option>
												<option value="SA" <?= $vpnEditInfo['country'] == 'SA' ? 'selected' : '' ?>>Saudi Arabia</option>
												<option value="SN" <?= $vpnEditInfo['country'] == 'SN' ? 'selected' : '' ?>>Senegal</option>
												<option value="RS" <?= $vpnEditInfo['country'] == 'RS' ? 'selected' : '' ?>>Serbia</option>
												<option value="SC" <?= $vpnEditInfo['country'] == 'SC' ? 'selected' : '' ?>>Seychelles</option>
												<option value="SL" <?= $vpnEditInfo['country'] == 'SL' ? 'selected' : '' ?>>Sierra Leone</option>
												<option value="SG" <?= $vpnEditInfo['country'] == 'SG' ? 'selected' : '' ?>>Singapore</option>
												<option value="SX" <?= $vpnEditInfo['country'] == 'SX' ? 'selected' : '' ?>>Sint Maarten (Dutch part)</option>
												<option value="SK" <?= $vpnEditInfo['country'] == 'SK' ? 'selected' : '' ?>>Slovakia</option>
												<option value="SI" <?= $vpnEditInfo['country'] == 'SI' ? 'selected' : '' ?>>Slovenia</option>
												<option value="SB" <?= $vpnEditInfo['country'] == 'SB' ? 'selected' : '' ?>>Solomon Islands</option>
												<option value="SO" <?= $vpnEditInfo['country'] == 'SO' ? 'selected' : '' ?>>Somalia</option>
												<option value="ZA" <?= $vpnEditInfo['country'] == 'ZA' ? 'selected' : '' ?>>South Africa</option>
												<option value="GS" <?= $vpnEditInfo['country'] == 'GS' ? 'selected' : '' ?>>South Georgia and the South Sandwich Islands</option>
												<option value="SS" <?= $vpnEditInfo['country'] == 'SS' ? 'selected' : '' ?>>South Sudan</option>
												<option value="ES" <?= $vpnEditInfo['country'] == 'ES' ? 'selected' : '' ?>>Spain</option>
												<option value="LK" <?= $vpnEditInfo['country'] == 'LK' ? 'selected' : '' ?>>Sri Lanka</option>
												<option value="SD" <?= $vpnEditInfo['country'] == 'SD' ? 'selected' : '' ?>>Sudan</option>
												<option value="SR" <?= $vpnEditInfo['country'] == 'SR' ? 'selected' : '' ?>>Suriname</option>
												<option value="SJ" <?= $vpnEditInfo['country'] == 'SJ' ? 'selected' : '' ?>>Svalbard and Jan Mayen</option>
												<option value="SZ" <?= $vpnEditInfo['country'] == 'SZ' ? 'selected' : '' ?>>Swaziland</option>
												<option value="SE" <?= $vpnEditInfo['country'] == 'SE' ? 'selected' : '' ?>>Sweden</option>
												<option value="CH" <?= $vpnEditInfo['country'] == 'CH' ? 'selected' : '' ?>>Switzerland</option>
												<option value="SY" <?= $vpnEditInfo['country'] == 'SY' ? 'selected' : '' ?>>Syrian Arab Republic</option>
												<option value="TW" <?= $vpnEditInfo['country'] == 'TW' ? 'selected' : '' ?>>Taiwan, Province of China</option>
												<option value="TJ" <?= $vpnEditInfo['country'] == 'TJ' ? 'selected' : '' ?>>Tajikistan</option>
												<option value="TZ" <?= $vpnEditInfo['country'] == 'TZ' ? 'selected' : '' ?>>Tanzania, United Republic of</option>
												<option value="TH" <?= $vpnEditInfo['country'] == 'TH' ? 'selected' : '' ?>>Thailand</option>
												<option value="TL" <?= $vpnEditInfo['country'] == 'TL' ? 'selected' : '' ?>>Timor-Leste</option>
												<option value="TG" <?= $vpnEditInfo['country'] == 'TG' ? 'selected' : '' ?>>Togo</option>
												<option value="TK" <?= $vpnEditInfo['country'] == 'TK' ? 'selected' : '' ?>>Tokelau</option>
												<option value="TO" <?= $vpnEditInfo['country'] == 'TO' ? 'selected' : '' ?>>Tonga</option>
												<option value="TT" <?= $vpnEditInfo['country'] == 'TT' ? 'selected' : '' ?>>Trinidad and Tobago</option>
												<option value="TN" <?= $vpnEditInfo['country'] == 'TN' ? 'selected' : '' ?>>Tunisia</option>
												<option value="TR" <?= $vpnEditInfo['country'] == 'TR' ? 'selected' : '' ?>>Turkey</option>
												<option value="TM" <?= $vpnEditInfo['country'] == 'TM' ? 'selected' : '' ?>>Turkmenistan</option>
												<option value="TC" <?= $vpnEditInfo['country'] == 'TC' ? 'selected' : '' ?>>Turks and Caicos Islands</option>
												<option value="TV" <?= $vpnEditInfo['country'] == 'TV' ? 'selected' : '' ?>>Tuvalu</option>
												<option value="UG" <?= $vpnEditInfo['country'] == 'UG' ? 'selected' : '' ?>>Uganda</option>
												<option value="UA" <?= $vpnEditInfo['country'] == 'UA' ? 'selected' : '' ?>>Ukraine</option>
												<option value="AE" <?= $vpnEditInfo['country'] == 'AE' ? 'selected' : '' ?>>United Arab Emirates</option>
												<option value="GB" <?= $vpnEditInfo['country'] == 'GB' ? 'selected' : '' ?>>United Kingdom</option>
												<option value="US" <?= $vpnEditInfo['country'] == 'US' ? 'selected' : '' ?>>United States</option>
												<option value="UM" <?= $vpnEditInfo['country'] == 'UM' ? 'selected' : '' ?>>United States Minor Outlying Islands</option>
												<option value="UY" <?= $vpnEditInfo['country'] == 'UY' ? 'selected' : '' ?>>Uruguay</option>
												<option value="UZ" <?= $vpnEditInfo['country'] == 'UZ' ? 'selected' : '' ?>>Uzbekistan</option>
												<option value="VU" <?= $vpnEditInfo['country'] == 'VU' ? 'selected' : '' ?>>Vanuatu</option>
												<option value="VE" <?= $vpnEditInfo['country'] == 'VE' ? 'selected' : '' ?>>Venezuela, Bolivarian Republic of</option>
												<option value="VN" <?= $vpnEditInfo['country'] == 'VN' ? 'selected' : '' ?>>Viet Nam</option>
												<option value="VG" <?= $vpnEditInfo['country'] == 'VG' ? 'selected' : '' ?>>Virgin Islands, British</option>
												<option value="VI" <?= $vpnEditInfo['country'] == 'VI' ? 'selected' : '' ?>>Virgin Islands, U.S.</option>
												<option value="WF" <?= $vpnEditInfo['country'] == 'WF' ? 'selected' : '' ?>>Wallis and Futuna</option>
												<option value="EH" <?= $vpnEditInfo['country'] == 'EH' ? 'selected' : '' ?>>Western Sahara</option>
												<option value="YE" <?= $vpnEditInfo['country'] == 'YE' ? 'selected' : '' ?>>Yemen</option>
												<option value="ZM" <?= $vpnEditInfo['country'] == 'ZM' ? 'selected' : '' ?>>Zambia</option>
												<option value="ZW" <?= $vpnEditInfo['country'] == 'ZW' ? 'selected' : '' ?>>Zimbabwe</option>
											</select>
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Enter URL or upload file?</label>
											<select id="ovpnType" class="form-control" onchange="toggleOvpnType(this)">
												<option value="path" selected>Enter an OVPN file URL</option>
												<option value="file">Upload an OVPN file</option>
											</select>
										</div>
										<div id="ovpnFileUpload" class="input-group input-group-outline mb-3 is-filled" style="display:none">
											<label class="form-label">OVPN File</label>
											<input name="ovpnfile" type="file" class="form-control">
										</div>
										<div id="ovpnPathEntry" class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">OVPN Path</label>
											<input name="ovpnpath" type="text" class="form-control" value="<?php echo $vpnEditInfo['path'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Auth Type</label>
											<select name="authtype" class="form-control">
												<?php
												$noupSelected = "";
												$upSelected = "";
												$kpSelected = "";
												if ($vpnEditInfo['auth_type'] == "noup") {
													$noupSelected = " selected";
												} else if ($vpnEditInfo['auth_type'] == "up") {
													$upSelected = " selected";
												} else if ($vpnEditInfo['auth_type'] == "kp") {
													$kpSelected = " selected";
												}
												?>
												<option value="noup" <?php echo $noupSelected; ?>>Username and Password not required</option>
												<option value="up" <?php echo $upSelected; ?>>Username and Password</option>
												<option value="kp" <?php echo $kpSelected; ?>>Key file password</option>
											</select>
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Username</label>
											<input name="username" type="text" class="form-control" value="<?php echo $vpnEditInfo['username'] ?>">
										</div>
										<div class="input-group input-group-outline mb-3 is-filled">
											<label class="form-label">Password</label>
											<input name="password" type="text" class="form-control" value="<?php echo $vpnEditInfo['password'] ?>">
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="authembedded" name="authembedded" <?php echo $authChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="authembedded">Is Auth Embedded?</label>
										</div>
										<div class="form-check form-switch d-flex align-items-center mb-3">
											<input class="form-check-input" type="checkbox" id="active" name="active" <?php echo $activeChecked; ?>>
											<label class="form-check-label mb-0 ms-3" for="active">Active</label>
										</div>
										<div class="text-center">
											<button name="updatevpn" type="submit" class="btn btn-lg bg-gradient-secondary btn-lg w-100 mt-4 mb-0">Update</button>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>