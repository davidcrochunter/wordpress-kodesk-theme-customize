/**
 * categoring
 */
function v4_filtering() {

	district_val = jQuery('#district_filter').val();
	usetype_val = jQuery('#usetype_filter').val();
	addcondition_val = jQuery('#addcondition_filter').val();

	if (district_val != 'DISTRICT') {
		jQuery('.v4-filter-form [name="district"]').val(district_val);
	}
	if (usetype_val != 'USETYPE') {
		jQuery('.v4-filter-form [name="usetype"]').val(usetype_val);
	}
	if (addcondition_val != 'ADDCONDITION') {
		jQuery('.v4-filter-form [name="addcondition"]').val(addcondition_val);
	}

	jQuery('form.v4-filter-form').trigger("submit");
}

/**
 * google mapping
 */
jQuery(function() {
	(g => {
		var h, a, k, p = "The Google Maps JavaScript API",
			c = "google",
			l = "importLibrary",
			q = "__ib__",
			m = document,
			b = window;
		b = b[c] || (b[c] = {});
		var d = b.maps || (b.maps = {}),
			r = new Set,
			e = new URLSearchParams,
			u = () => h || (h = new Promise(async (f, n) => {
				await (a = m.createElement("script"));
				e.set("libraries", [...r] + "");
				for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
				e.set("callback", c + ".maps." + q);
				a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
				d[q] = f;
				a.onerror = () => h = n(Error(p + " could not load."));
				a.nonce = m.querySelector("script[nonce]")?.nonce || "";
				m.head.append(a)
			}));
		d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
	})
	({
		key: "AIzaSyCeSmnkvGUNBtIgOsgTxerYLK_BGaXp3X4",
		v: "beta"
	});

	// Initialize and add the map
	let map;

	async function initMap() {
		// The location of Uluru
		const position = {
			lat: 52.52,
			lng: 13.41
		};
		// Request needed libraries.
		//@ts-ignore
		const {
			Map
		} = await google.maps.importLibrary("maps");
		const {
			AdvancedMarkerElement
		} = await google.maps.importLibrary("marker");

		// The map, centered at Uluru
		map = new Map(document.getElementById("map"), {
			zoom: 4,
			center: position,
			mapId: "DEMO_MAP_ID",
		});

		// The marker, positioned at Uluru
		const marker1 = new AdvancedMarkerElement({
			map: map,
			position: {
				lat: 52.549,
				lng: 13.422
			},
			title: "Uluru1",
		});

		// The marker, positioned at Uluru
		const marker2 = new AdvancedMarkerElement({
			map: map,
			position: {
				lat: 52.497,
				lng: 13.396
			},
			title: "Uluru2",
		});

		// The marker, positioned at Uluru
		const marker3 = new AdvancedMarkerElement({
			map: map,
			position: {
				lat: 52.517,
				lng: 13.394
			},
			title: "Uluru3",
		});

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			address: 'San Francisco'
		}, function(results, status) {
			if (status === 'OK') {
				var location = results[0].geometry.location;
				// Use the location coordinates to create a marker
				var marker = new google.maps.Marker({
					position: location,
					map: map,
					title: 'San Francisco' // Set the marker title
				});
			} else {
				console.error('Geocode was not successful for the following reason: ' + status);
			}
		});
	}

	if (jQuery("#map").length) {
		initMap();
	}
});