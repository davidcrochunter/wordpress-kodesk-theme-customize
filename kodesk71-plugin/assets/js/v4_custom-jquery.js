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

	marking_map = (latlngnames, wantPinLink = true, wantFitBounds = true, centerIndex = -1) => {

		// Automatically adjust the map's zoom and center to fit all markers
		bounds = new google.maps.LatLngBounds();

		// Marking the LatLng-Names
		// $workspace_gmap_addrs = jQuery('.workspace-gmap-addr');
		jWodkspace_gmap_addrs = latlngnames; //$workspace_gmap_addrs.toArray();
		jWodkspace_gmap_addrs.forEach(function(el, idx) {
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

					if(wantPinLink) {
						google.maps.event.addListener(marker, 'click', function() {
							window.location.href = latlngs_urls[idx];
						});
					}
					
					if(wantFitBounds) {
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
			var location = jWodkspace_gmap_addrs[centerIndex];
			geocoder.geocode( { 'address': location }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
				} else {
					alert("Could not find location: " + location);
				}
			});
		}

		console.log('bounds');
		console.log(bounds);
		console.log('getZoom');
		console.log(map.getZoom());



	}
	// Initialize and add the map
	let map;
	let latlngs_urls = [];


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
				latlngs_urls.push($(item).data('url'));
			});
			// marking_map(['San Francisco']);
			marking_map(latlngs);

			// console.log(`getZoom:${map.getZoom()}`);






			// setTimeout(() => {
			// 	map.setZoom(16);
			// }, 2000);
			// if(map.getZoom() > 16) {
			// }

		}
		if($('#v4-detail-latlng-names div').length > 0) {
			$('#v4-detail-latlng-names div').each(function (index, item) {
				latlngs.push($(item).text());
			});
			// marking_map(['San Francisco']);
			marking_map(latlngs, false, false, 0);
			console.log('zooming(11)');
			map.setZoom(16);
			console.log('zoomed(11)');
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

		if(!$('#v4-carts-view-area').is(":hidden") && is_remain_ajax && boundTop >= $bottomMarker.offset().top) {
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
	jQuery(window).on('resize', function(e) {
		// adjust the layout of carts and map view 
		if($(window).width() >= 1200 ) {
			$('#v4-carts-view-area').show();
			$('#v4-map-view-area').show();
		}

		// adjust the width of workspace options multi-select
		w0 = $('#cbox-input').width();
		$('[role="listbox"]').width(w0+55);
		
	});
	jQuery(window).trigger('resize');

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

/**
 * conversion between laptop and mobile
 */
jQuery(document).ready(function($) {
	$('#v4-mini-map-btn').on('click', function(event) {
		// debugger;
		// const carts_view = document.getElementById('v4-carts-view-area');
		// const isCatsViewNone = carts_view.display === 'none';
		if($('#v4-carts-view-area').is(":hidden")) {
			$('#v4-carts-view-area').show();
			$('#v4-map-view-area').hide();
			
			$('#v4-mini-map-btn i').removeClass('fa-list');
			$('#v4-mini-map-btn i').addClass('fa-map');


		} else {
			$('#v4-carts-view-area').hide();
			$('#v4-map-view-area').show();

			$('#v4-mini-map-btn i').removeClass('fa-map');
			$('#v4-mini-map-btn i').addClass('fa-list');
		}

	});
});


jQuery(function ($) {

	params = new URLSearchParams(window.location.search);
	district       = params.get('district');
	usetype        = params.get('usetype');
	addcondition   = params.get('addcondition');
	if(district == null || district == '') {
		$('#district-sel option:first-child').text('—Please choose an district—');
	} else {
		const array = district.split('-');
		const newArr = array.map(function (item) {
			firstChar = item.substring(0,1);
			firstChar = firstChar.toUpperCase();
			item = item.slice(1);
			item = firstChar + item;

			return item;
		})

		district = newArr.join(' ');
		$('#district-sel option[value="'+district+'"]').attr("selected","selected");
	}
	if(usetype == null || usetype == '') {
		$('#usetype-sel option:first-child').text('—Please choose an type—');
	} else {
		const array = usetype.split('-');
		const newArr = array.map(function (item) {
			firstChar = item.substring(0,1);
			firstChar = firstChar.toUpperCase();
			item = item.slice(1);
			item = firstChar + item;

			return item;
		})

		usetype = newArr.join(' ');
		$('#usetype-sel option[value="'+usetype+'"]').attr("selected","selected");

	}
	if(addcondition == null || addcondition == '') {
		$('#cbox-input').text('—Please choose an options—');
	} else {
		const arr = addcondition.split(',');
		arr.forEach(function(item) {
			item = item.replace(/ /g, "-");
			$('[role="listbox"] li#'+item).attr('aria-selected', 'true')
		});

		const newArr = arr.map(function (option) {
			const array = option.split('-');
			const newArr = array.map(function (item) {
				firstChar = item.substring(0,1);
				firstChar = firstChar.toUpperCase();
				item = item.slice(1);
				item = firstChar + item;
	
				return item;
			})

			option = newArr.join(' ');

			return option;
		})
		options_label = newArr.join(', ');

		$('#cbox-input').text(options_label);

	}


	// $('#district-sel option:first-child').text('—Please choose an district—');
	// $('#usetype-sel option:first-child').text('—Please choose an type—');
	// $('#cbox-input').text('—Please choose an options—');


	$('#v4-ws-search, #v4-ws-search-btn').on('click', function(event) {

		console.log('ddddddddddddddd');

		district_val = jQuery('.district-sel-cls > span').text();
		if( district_val.includes("choose an ") ) {
			district_val = '';
		} else {
			district_val = district_val.replace(/ /g, "-");
			district_val = district_val.toLowerCase();
		}


		usetype_val = jQuery('.usetype-sel-cls > span').text();
		if( usetype_val.includes("choose an ") ) {
			usetype_val = '';
		} else {
			usetype_val = usetype_val.replace(/ /g, "-");
			usetype_val = usetype_val.toLowerCase();
		}


		addcondition_val = jQuery('#cbox-input').text();
		if( addcondition_val.includes("choose an ") ) {
			addcondition_val = '';
		} else {
			// Select the unordered list items using jQuery
			var list = $('[role="listbox"] li[aria-selected="true"]');
					
			// Convert the list to an array using the makeArray method of jQuery
			var array = $.makeArray(list);

			// Map each item in the array to its innerHTML property
			let items = array.map((item) => {
				item = item.innerHTML;
				item = item.replace(/<\/?[^>]+(>|$)/g, "");
				item = item.replace(/\t/g, '');
				item = item.replace(/\n/g, '');
				item = item.toLowerCase();

				return item;
			});

			addcondition_val = items.toString();
		}

		jQuery('.v4-filter-form [name="district"]').val(district_val);
		jQuery('.v4-filter-form [name="usetype"]').val(usetype_val);
		jQuery('.v4-filter-form [name="addcondition"]').val(addcondition_val);

		// addcondition_val = jQuery('#addcondition_filter').val();
	
		// if (district_val != 'DISTRICT') {
		// 	jQuery('.v4-filter-form [name="district"]').val(district_val);
		// }
		// if (usetype_val != 'USETYPE') {
		// 	jQuery('.v4-filter-form [name="usetype"]').val(usetype_val);
		// }
		// if (addcondition_val != 'ADDCONDITION') {
		// 	jQuery('.v4-filter-form [name="addcondition"]').val(addcondition_val);
		// }
	
		jQuery('form.v4-filter-form').trigger("submit");
	













	});

	var $cbox = $('[role="combobox"]');
	var $togglebutt = $('button.toggle');
	var $clearbutt = $('button.clear');
	var $lbox = $('[role="listbox"]');

	function isOpen() {
		if ($cbox.attr('aria-expanded') == 'true') { return true; } else { return false; }
	}	
	function openLB() {
		$cbox.attr('aria-expanded', 'true');

		$lbox.show();






	}
	function closeLB() {
		$cbox.attr('aria-expanded', 'false');
		$lbox.hide();
		clearActiveDescendant();
	}
	function toggleLB() {
		if (isOpen()) {
			closeLB();
			//$cbox.focus();
		} else {
			openLB();
		}
	}
	function getActiveDescendant() {
		if ($cbox.attr('aria-activedescendant')) {
			return $('#' + $cbox.attr('aria-activedescendant'));
		}
	}
	function setActiveDescendant($option) {
		if (getActiveDescendant()) {
			getActiveDescendant().removeClass('activedescendant');
		} 
		$cbox.attr('aria-activedescendant', $option.attr('id'));
		$('#' + $cbox.attr('aria-activedescendant')).attr('class', 'activedescendant');
	}
	function clearActiveDescendant() {
		if (getActiveDescendant()) {
			getActiveDescendant().removeClass('activedescendant');
		}		
		$cbox.attr('aria-activedescendant', '');
	}
	function getSelectedOptionsStr() {
		var options_str = '';
		var $selectedOptions = $('li[aria-selected="true"]', $lbox);
		if ($selectedOptions.length > 0) {
			$selectedOptions.each(function() {
				options_str += $(this).text() + ', ';
			});
			options_str = options_str.slice(0, -2);
			$cbox.addClass('selections');
			$togglebutt.hide();
			$clearbutt.show();
		} else {
			options_str = "";
			$cbox.removeClass('selections');
			$clearbutt.hide();
			$togglebutt.show();
		}
		return options_str;
	}
	function clearSelectedOptions() {
		$cbox.text("");
		$('li[aria-selected="true"]', $lbox).attr('aria-selected', 'false');
		$cbox.removeClass('selections');
		$clearbutt.hide();
		$togglebutt.show();
		if (isOpen()) {closeLB();}
		$cbox.focus();
	}
	
	function toggleSelection($option) {
		if ($option.attr('aria-selected') == 'false') {
			$option.attr('aria-selected', 'true');
		} else {
			$option.attr('aria-selected', 'false');
		}

		if(getSelectedOptionsStr() == '') {
			$cbox.text('—Please choose an options—')
		} else {
			$cbox.text(getSelectedOptionsStr());
		}
	}
	function getDefaultOption() {
		if ($('li[aria-selected="true"]', $lbox).length > 0) {
			return $('li[aria-selected="true"]', $lbox).eq(0);
		} else {
			return $('li:first-child', $lbox);
		}
	}
	function getNextOption() {
		if (getActiveDescendant()) {
			var ad_index = getActiveDescendant().index();
			if (ad_index == $('li', $lbox).length - 1) {
				return $('li:first-child', $lbox);
			} else {
				return $('li', $lbox).eq(ad_index + 1);
			}
		} else {
			return getDefaultOption();
		}
	}
	function getPreviousOption() {
		if (getActiveDescendant()) {
			var ad_index = getActiveDescendant().index();
			if (ad_index === 0) {
				return $('li:last-child', $lbox);
			} else {
				return $('li', $lbox).eq(ad_index - 1);
			}
		} else {
			return getDefaultOption();
		}
	}
	
	//Events
	$cbox.on('click', function (e) {
		toggleLB();
		$(".nice-select.wpcf7-form-control.wpcf7-select").removeClass('open');

		if($('#cbox-input').hasClass('open')) {
			$('#cbox-input').removeClass('open');
		} else {
			$('#cbox-input').addClass('open');
		}

		e.stopPropagation();
	});
	$togglebutt.on('click', function (e) {
		toggleLB();
		//$cbox.focus();
		e.stopPropagation();
	});
	$clearbutt.on('click', function(e) {
		clearSelectedOptions();
		e.stopPropagation();
	});
	
	var altPressed = false;
	$cbox.on('keydown', function (e) {
		switch (e.which) {
			case 18: //Alt
				altPressed = true;
				break;
			case 27: //Esc
				if (isOpen()) {
					closeLB();
					//$cbox.focus();
				}	
				break;
			case 9: //Tab
				if (isOpen()) {
					closeLB();
				}
				break;
			case 13: //Enter
				toggleSelection(getActiveDescendant());
				closeLB();
				break;
			case 32: //Space
				if (!isOpen()) {
					//$lbox.focus();
					toggleLB();
					setActiveDescendant(getDefaultOption());
				} else {
					toggleSelection(getActiveDescendant());
				}
				e.preventDefault();
				break;
			case 38: //Up arrow
				if (altPressed == true) {
					closeLB();
				} else if (!isOpen()) {
					openLB();		
					//$lbox.focus();
					setActiveDescendant(getDefaultOption());
				} else {
					setActiveDescendant(getPreviousOption());
				}				
				e.preventDefault();
				break;
			case 40: //Down arrow
				if (!isOpen()) {
					openLB();							
								
				//$lbox.focus();
					setActiveDescendant(getDefaultOption());
				} else {
					setActiveDescendant(getNextOption());

				}
				e.preventDefault();
				break;
			default:
				return true;
		}
	});
	$cbox.on('keyup', function (e) {
		if (e.which == 18) {
			altPressed = false;
		}
	});
	$('li', $lbox).on('click', function(e) {
		toggleSelection($(this));
		setActiveDescendant($(this));
		e.stopPropagation();
	});

	$('html').on('click', function() {
		if (isOpen()) {
			closeLB();
		}
	});
	$('html').on('keydown', function (e) {
		if (e.which == 27 && isOpen()) {
			closeLB();
		} 
	});


});