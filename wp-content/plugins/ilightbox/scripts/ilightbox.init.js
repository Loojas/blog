jQuery(document).ready(function($) {
	function rawurldecode(str) {
		return decodeURIComponent((str + '').replace(/%(?![\da-f]{2})/gi, function() {
			// PHP tolerates poorly formed escape sequences
			return '%25';
		}));
	}

	function debounce(delay, no_trailing, callback, debounce_mode) {
		// After wrapper has stopped being called, this timeout ensures that
		// `callback` is executed at the proper times in `throttle` and `end`
		// debounce modes.
		var timeout_id,

			// Keep track of the last time `callback` was executed.
			last_exec = 0;

		// `no_trailing` defaults to falsy.
		if (typeof no_trailing !== 'boolean') {
			debounce_mode = callback;
			callback = no_trailing;
			no_trailing = undefined;
		}

		// The `wrapper` function encapsulates all of the throttling / debouncing
		// functionality and when executed will limit the rate at which `callback`
		// is executed.
		function wrapper() {
			var that = this,
				elapsed = +new Date() - last_exec,
				args = arguments;

			// Execute `callback` and update the `last_exec` timestamp.
			function exec() {
				last_exec = +new Date();
				callback.apply(that, args);
			};

			// If `debounce_mode` is true (at_begin) this is used to clear the flag
			// to allow future `callback` executions.
			function clear() {
				timeout_id = undefined;
			};

			if (debounce_mode && !timeout_id) {
				// Since `wrapper` is being called for the first time and
				// `debounce_mode` is true (at_begin), execute `callback`.
				exec();
			}

			// Clear any existing timeout.
			timeout_id && clearTimeout(timeout_id);

			if (debounce_mode === undefined && elapsed > delay) {
				// In throttle mode, if `delay` time has been exceeded, execute
				// `callback`.
				exec();

			} else if (no_trailing !== true) {
				// In trailing throttle mode, since `delay` time has not been
				// exceeded, schedule `callback` to execute `delay` ms after most
				// recent execution.
				// 
				// If `debounce_mode` is true (at_begin), schedule `clear` to execute
				// after `delay` ms.
				// 
				// If `debounce_mode` is false (at end), schedule `callback` to
				// execute after `delay` ms.
				timeout_id = setTimeout(debounce_mode ? clear : exec, debounce_mode === undefined ? delay - elapsed : delay);
			}
		};

		// Set the guid of `wrapper` function to the same of original callback, so
		// it can be removed in jQuery 1.4+ .unbind or .die by using the original
		// callback as a reference.
		if ($.guid) {
			wrapper.guid = callback.guid = callback.guid || $.guid++;
		}

		// Return the wrapper function.
		return wrapper;
	};

	var globalOptions = ILIGHTBOX.options && eval("(" + ILIGHTBOX.options + ")") || {},
		bindedGalleries = ILIGHTBOX.bindedGalleries,
		galleries = $('.ilightbox_gallery'),
		jetpackGalleries = $('.tiled-gallery'),
		nextGenGalleries = $('.ngg-galleryoverview');

	if (galleries.length) {
		galleries.each(function() {
			var t = $(this),
				kid = $('a[source]', t),
				options = t.data("options") && eval("(" + rawurldecode(t.data("options")) + ")") || {};

			if (options.linkId && t.hasClass('gallery'))
				options.linkId = t[0].id;

			ILIGHTBOX.instances.push(kid.iLightBox(options));
		});
	}

	if (jetpackGalleries.length && ILIGHTBOX.jetPack) {
		jetpackGalleries.each(function(index) {
			var t = $(this),
				kid = $('a', t),
				options = $.extend({}, globalOptions);
			options.attr = 'source';

			if (options.linkId)
				options.linkId = 'tiledGallery-' + index;

			kid.each(function(i) {
				var $this = $(this),
					$img = $('img', $this),
					$caption = $('.tiled-gallery-caption', $this.parent()),
					origFile = $img.data('orig-file');

				$this.attr('source', origFile);

				if ($caption[0])
					$this.attr('data-caption', $caption.text());

				var events = jQuery._data( this, "events" );
				if (events && events.click)
					delete events.click;
			});
			ILIGHTBOX.instances.push(kid.iLightBox(options));
		});
	}

	$(window).load(function() {
		if (nextGenGalleries.length && ILIGHTBOX.nextGEN) {
			nextGenGalleries.each(function(index) {
				var t = $(this),
					kid = $('.ngg-gallery-thumbnail a', t),
					options = $.extend({}, globalOptions);

				if (options.linkId)
					options.linkId = 'nextGenGallery-' + index;

				kid.each(function(i) {
					var $this = $(this),
						title = $this.data('title'),
						description = $this.data('description');
					if (description.length > 0 || title.length > 0) {
						$this.data('caption', description.length > 0 ? description : title);
					}
					if (title.length > 0 && description.length === 0) {
						$this.data('title', null);
					}
					$this[0].onclick = null;
					var events = jQuery._data( this, "events" );
					if (events && events.click)
						delete events.click;
				});
				ILIGHTBOX.instances.push(kid.iLightBox(options));
			});
		}
	});

	$(document).on('click', '.ilightbox_inline_gallery', function() {
		var t = $(this),
			slides = t.data("slides") && eval("(" + rawurldecode(t.data("slides")) + ")") || [];
		options = t.data("options") && eval("(" + rawurldecode(t.data("options")) + ")") || {};
		$.iLightBox(slides, options);
	});


	var selectorString,
		not = true,
		enabledGroups = [];

	if (ILIGHTBOX.autoEnable && ILIGHTBOX.autoEnableVideos) {
		selectorString = 'a[href$=".jpg"],a[href$=".jpeg"],a[href$=".jpe"],a[href$=".jfif"],a[href$=".gif"],a[href$=".png"],a[href$=".tif"],a[href$=".tiff"],a[href$=".avi"],a[href$=".mov"],a[href$=".mpg"],a[href$=".mpeg"],a[href$=".mp4"],a[href$=".webm"],a[href$=".ogg"],a[href$=".ogv"],a[href$=".3gp"],a[href$=".m4v"],a[href$=".swf"],[rel="ilightbox"]';
	}
	else if (ILIGHTBOX.autoEnable) {
		selectorString = 'a[href$=".jpg"],a[href$=".jpeg"],a[href$=".jpe"],a[href$=".jfif"],a[href$=".gif"],a[href$=".png"],a[href$=".tif"],a[href$=".tiff"],[rel="ilightbox"]';
	}
	else if (ILIGHTBOX.autoEnableVideos) {
		selectorString = 'a[href$=".avi"],a[href$=".mov"],a[href$=".mpg"],a[href$=".mpeg"],a[href$=".mp4"],a[href$=".webm"],a[href$=".ogg"],a[href$=".ogv"],a[href$=".3gp"],a[href$=".m4v"],a[href$=".swf"],[rel="ilightbox"]';
	}
	else {
		selectorString = '[rel="ilightbox"]';
		not = false;
	}

	function handleLinks() {
		// Single links
		var $links = not ? $(selectorString).not('[rel^="ilightbox["]') : $(selectorString);
		$links.not('.ilightbox-enabled, .ilightbox-disabled').each(function(){
			var $this = $(this);

			// Skip if the link enabled before
			if ($this.hasClass('ilightbox-enabled'))
				return true;

			// Remove click events
			var events = jQuery._data(this, "events");
			if(events && events.click)
				delete events.click;

			// Add .ilightbox-enabled class to the link
			$this.addClass('ilightbox-enabled');

			if(!$this.parents('.ilightbox_gallery')[0] && !$this.parents('.tiled-gallery')[0] && !$this.parents('.ngg-galleryoverview')[0])
				$this.iLightBox(globalOptions);
		});

		// Grouped links
		var groups = [];

		$('[rel^="ilightbox["]').each(function(){
			var rel = this.getAttribute("rel");

			if ($.inArray(rel, groups) === -1 && $.inArray(rel, enabledGroups) === -1) {
				groups.push(rel);
				enabledGroups.push(rel);
			}
		});

		$.each(groups,function(i, group){
			ILIGHTBOX.instances.push($('[rel="' + group + '"]').iLightBox(globalOptions));
		});

		if (ILIGHTBOX.autoEnableVideoSites) {
			var newGlobalOptions = $.extend({}, globalOptions, {
				smartRecognition: true
			});

			$('a[href*="youtu.be/"],a[href*="youtube.com/watch"],a[href*="vimeo.com"],a[href*="metacafe.com/watch"],a[href*="dailymotion.com/video"],a[href*="hulu.com/watch"]')
			.not('[rel*="ilightbox"], .ilightbox-enabled, .ilightbox-disabled').each(function(){
				var $this = $(this);

				// Skip if the link enabled before
				if ($this.hasClass('ilightbox-enabled'))
					return true;

				// Remove click events
				var events = jQuery._data(this, "events");
				if(events && events.click)
					delete events.click;

				if(!$this.parents('.ilightbox_gallery')[0] && !$this.parents('.tiled-gallery')[0] && !$this.parents('.ngg-galleryoverview')[0])
					$this.iLightBox(newGlobalOptions);
			});
		}
	}

	handleLinks();


	// Binded Galleries
	if (bindedGalleries.length) {
		$.each(bindedGalleries, function (i, item) {
			var object = JSON.parse(item),
				event = object.event,
				query = object.query,
				retrn = object.return,
				once = object.once,
				slides = object.slides && eval(object.slides) || [],
				options = object.options && eval("(" + object.options + ")") || {},
				fn = function () {
					if (once && document.cookie.replace(new RegExp("(?:(?:^|.*;\\s*)once" + object.id + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1") === "true")
						return;

					$.iLightBox(slides, options);

					if (once)
						document.cookie = "once" + object.id + "=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";

					if (retrn)
						return!1;
				};

			try {
				if (/^'/.test(query))
					$(document).on(event + ".ilightbox", query.replace(/\'|\"/g, ""), fn);
				else
					$(eval(query)).on(event + ".ilightbox", fn);
			}
			catch (e) {
				if (typeof console !== 'undefined')
					console[console.warn ? 'warn' : 'log']('iLightBox: Your binded gallery is not valid -> ' + e);
			}
		});
	}


	window.refreshiLightBoxInstances = debounce(500, function(mutations) {
		var isArray = $.isArray(mutations),
			mutation = isArray ? mutations[0] : mutations,
			target;

		if (isArray)
			target = (mutation.target === document.body ? (mutation.addedNodes[0] || mutation.removedNodes[0] || mutation.target) : mutation.target);
		else
			target = mutation.target || document.body;

		if (!ILIGHTBOX.instances.length || target.className.match(/ilightbox-overlay|ilightbox-loader|ilightbox-holder|ilightbox-container|ilightbox-image|ilightbox-toolbar|ilightbox-close|ilightbox-fullscreen|ilightbox-prev-button|ilightbox-next-button|ilightbox-thumbnails|ilightbox-thumbnail/))
			return;

		$.each(ILIGHTBOX.instances, function(){
			this.refresh();
		});

		// Handle added new links
		handleLinks();
	}, false);

	if (typeof MutationObserver !== 'undefined') {
		var observer = new MutationObserver(refreshiLightBoxInstances);
		observer.observe(document.body, {
			childList: true,
			subtree: true
		});
	}
	else
		$(document).bind('DOMNodeInserted DOMNodeRemoved', refreshiLightBoxInstances);
});