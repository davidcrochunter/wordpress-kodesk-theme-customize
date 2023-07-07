/**
 * filtering
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
jQuery(function($) {
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

	marking_map = (latlngnames, isFitBounds = true, centerIndex = -1) => {

		// Automatically adjust the map's zoom and center to fit all markers
		bounds = new google.maps.LatLngBounds();

		// Marking the LatLng-Names
		// $workspace_gmap_addrs = jQuery('.workspace-gmap-addr');
		jWodkspace_gmap_addrs = latlngnames; //$workspace_gmap_addrs.toArray();
		jWodkspace_gmap_addrs.forEach(function(el) {
			// Do something with each element in the JavaScript object array
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				address: el
			}, function(results, status) {
				if (status === 'OK') {
					var location = results[0].geometry.location;
					// Use the location coordinates to create a marker
					var marker = new google.maps.Marker({
						position: location,
						map: map,
						title: el // Set the marker title
					});
					if(isFitBounds) {
						bounds.extend( marker.getPosition() );
						map.fitBounds( bounds );
					}

				} else {
					console.error('Geocode was not successful for the following reason: ' + status);
				}
			});
		});

		if(centerIndex != -1) {
			var geocoder = new google.maps.Geocoder();
			var location = jWodkspace_gmap_addrs[0];
			geocoder.geocode( { 'address': location }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
				} else {
					alert("Could not find location: " + location);
				}
			});

		}

	}
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
    /*
		// The marker, positioned at Uluru1
		const marker1 = new AdvancedMarkerElement({
			map: map,
			position: {
				lat: 52.549,
				lng: 13.422
			},
			title: "Uluru1",
		});

    var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			address: 'San Francisco'
		}, function(results, status) {
        debugger;
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
    */
		const latlngs = [];
		if($('#v4-latlng-names div').length > 0) {
			$('#v4-latlng-names div').each(function (index, item) {
				latlngs.push($(item).text());
			});
			// marking_map(['San Francisco']);
			marking_map(latlngs);

		}
		if($('#v4-detail-latlng-names div').length > 0) {
			$('#v4-detail-latlng-names div').each(function (index, item) {
				latlngs.push($(item).text());
			});
			// marking_map(['San Francisco']);
			marking_map(latlngs, false, 0);
			map.setZoom(6);

		}

	}

	if (jQuery("#map").length) {

		console.log('dddd');
		latlngs = $('#v4-latlng-names div');
		console.log(latlngs);

		initMap();
	}
});

/**
 * button swipe down ajax load
 */
jQuery(document).ready(function($) {
	is_v4_ajax_loading   = false;
	is_v4_over_scrolling = false;

    // Your code here
    $('.infinite-scroll-workspace-button.button').on('click', function(event) {
		if(is_v4_ajax_loading) {
			return;
		}
		is_v4_ajax_loading = true;
		$('#v4-ajax-sppiner').show(true);

        // We will do our magic here soon!
		// debugger;
        params = new URLSearchParams(window.location.search);
        district       = params.get('district');
        usetype        = params.get('usetype');
        addcondition   = params.get('addcondition');
        paged          = $(event.target).data('paged');
        max_pages      = $(event.target).data('max-pages');
		workspace_cat  = $('.workspaces-page-section').data('workspace-cat')

        if(paged >= max_pages) {
            // hide load more button...
			$('.infinite-scroll-workspace-action').remove();

			is_v4_ajax_loading = false;
			is_v4_over_scrolling = false;
			$('#v4-ajax-sppiner').show(false);
            return;
        }

        // increase current page number by +1;
        paged = parseInt(paged);
        paged++;

        data = {district, usetype, addcondition, paged, workspace_cat};

        function callback(res) {

			// response logging
            // console.log(res);

			// update content by the response data
            cls = `.workspaces-content-side > div:eq(0)`;
            $(cls).append(res);
			jQuery('.workspaces-block-two').toArray().forEach(function(el){
				jQuery(el).css('visibility','visible');
				jQuery(el).show();
			});

			// update current paged value
            $(event.target).data('paged', paged);

			// determin whether will hide load more button or not
            max_pages = parseInt(max_pages);
            if(paged >= max_pages) {
                $('.infinite-scroll-workspace-action').remove();
                $('.infinite-scroll-workspace-status').remove();
            }

			is_v4_ajax_loading = false;
			is_v4_over_scrolling = false;
			$('#v4-ajax-sppiner').show(false);
        }

        ajax_send_req(
            /*type:     */'post',
            /*dataType: */'html',
            /*action:   */'v4_workspace_data_fetch',
            /*data:     */data,
            /*callback: */callback
        );

    });

});

/**
 * scroll swipe down ajax load
 */
jQuery(document).ready(function($) {

	$bottomMarker = $('#v4-ajax-sppiner');//$('.cta-section .outer-container');
	stop_scroll_pos = 0;

	jQuery(window).on('scroll', function(e) {

		$load_more_btn = $('.infinite-scroll-workspace-button.button');//This line must be here, only in scroll function.
		is_remain_ajax = $load_more_btn.length > 0 ? true : false;
		
		// Check if the user has scrolled to the bottom of the container
		currentTop = $(window).scrollTop();
		boundTop = currentTop + $(window).height();

		if(is_remain_ajax && boundTop >= $bottomMarker.offset().top) {
			if(!is_v4_over_scrolling) {

				is_v4_over_scrolling = true;

				delta = 40/*$bottomMarker.offset().height()*/ - (boundTop - $bottomMarker.offset().top);

				stop_scroll_pos = currentTop + delta;
				document.documentElement.scrollTop = document.body.scrollTop = stop_scroll_pos;
				// Perform AJAX request
				if( $load_more_btn ) {
					$load_more_btn.click();
				}
				
			} else {
				document.documentElement.scrollTop = document.body.scrollTop = stop_scroll_pos;
			}
		}
	});
});

/**
 * send email via emailjs.com
 */
/*
(function() {
	// https://dashboard.emailjs.com/admin/account
	// emailjs.init('YOUR_PUBLIC_KEY');
	emailjs.init('GzBvVF2-Pn7kHvAfD');
})();
window.onload = function() {
	document.getElementById('contact-form').addEventListener('submit', function(event) {
		event.preventDefault();
		// generate a five digit number for the contact_number variable
		this.contact_number.value = Math.random() * 100000 | 0;
		// these IDs from the previous steps
		emailjs.sendForm('service_cu2hm7v', 'template_gqheeqw', this)
			.then(function() {
				console.log('SUCCESS!');
			}, function(error) {
				console.log('FAILED...', error);
			});
	});
}
*/
