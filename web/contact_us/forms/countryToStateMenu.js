/* Code by Allen Liu             */
/* http://www.randomsnippets.com */

function printStateMenu(country) {
	var stateSelect = '';
	if (country == 'US') {
		stateSelect = '<select name="state" id="state" onChange="document.getElementById(\'stateValue\').innerHTML = this.value;"><option value="AK">AK-Alaska</option><option value="AL">AL-Alabama</option><option value="AR">AR-Arkansas</option><option value="AZ">AZ-Arizona</option><option value="CA">CA-California</option><option value="CO">CO-Colorado</option><option value="CT">CT-Connecticut</option><option value="DC">DC-District of Columbia</option><option value="DE">DE-Delaware</option><option value="FL">FL-Florida</option><option value="GA">GA-Georgia</option><option value="HI">HI-Hawaii</option><option value="IA">IA-Iowa</option><option value="ID">ID-Idaho</option><option value="IL">IL-Illinois</option><option value="IN">IN-Indiana</option><option value="KS">KS-Kansas</option><option value="KY">KY-Kentucky</option><option value="LA">LA-Louisiana</option><option value="MA">MA-Massachusetts</option><option value="MD">MD-Maryland</option><option value="ME">ME-Maine</option><option value="MI">MI-Michigan</option><option value="MN">MN-Minnesota</option><option value="MO">MO-Missouri</option><option value="MS">MS-Mississippi</option><option value="MT">MT-Montana</option><option value="NC">NC-North Carolina</option><option value="ND">ND-North Dakota</option><option value="NE">NE-Nebraska</option><option value="NH">NH-New Hampshire</option><option value="NJ">NJ-New Jersey</option><option value="NM">NM-New Mexico</option><option value="NV">NV-Nevada</option><option value="NY">NY-New York</option><option value="OH">OH-Ohio</option><option value="OK">OK-Oklahoma</option><option value="OR">OR-Oregon</option><option value="PA">PA-Pennsylvania</option><option value="RI">RI-Rhode Island</option><option value="SC">SC-South Carolina</option><option value="SD">SD-South Dakota</option><option value="TN">TN-Tennessee</option><option value="TX">TX-Texas</option><option value="UT">UT-Utah</option><option value="VA">VA-Virginia</option><option value="VT">VT-Vermont</option><option value="WA">WA-Washington</option><option value="WI">WI-Wisconsin</option><option value="WV">WV-West Virginia</option><option value="WY">WY-Wyoming</option></select>';	
	}
	else if (country == 'CA') {
		stateSelect = '<select name="state" id="state" onChange="document.getElementById(\'stateValue\').innerHTML = this.value;"><option value="AB">AB-Alberta</option><option value="BC">BC-British Columbia</option><option value="MB">MB-Manitoba</option><option value="NB">NB-New Brunswick</option><option value="NL">NL-Newfoundland and Labrador</option><option value="NT">NT-Northwest Territories</option><option value="NS">NS-Nova Scotia</option><option value="NU">NU-Nunavut</option><option value="ON">ON-Ontario</option><option value="PE">PE-Prince Edward Island</option><option value="QC">QC-Quebec</option><option value="SK">SK-Saskatchewan</option><option value="YT">YT-Yukon</option></select>';
	}
	else {
		stateSelect = '<select name="state" id="state" disabled><option value="Other">Select state...</option></select>';
		document.getElementById('stateValue').innerHTML = 'Other';
	}
	document.getElementById('stateSelect').innerHTML = stateSelect;
	document.getElementById('countryValue').innerHTML = document.getElementById('country').value;
	document.getElementById('stateValue').innerHTML = document.getElementById('state').value;
}
