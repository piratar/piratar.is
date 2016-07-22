
// JQuery Plugin
jQuery(document).ready(function ($) {
	
    $.fn.pdfEmbedder = function() {

    	this.each(function(index, rawDivContainer) {

    		var divContainer = $(rawDivContainer);

   		    divContainer.append($('<div></div>', {'class': 'pdfemb-loadingmsg'}).append(document.createTextNode(pdfemb_trans.objectL10n.loading)));

            // Disable right click?

            if (divContainer.data('disablerightclick') == 'on') {
                divContainer.bind("contextmenu", function(e) {
                    e.preventDefault();
                });
            }

            // Load PDF

            var initPdfDoc = function(pdfDoc_, showIsSecure) {
                divContainer.empty().append(
                    $('<div></div>', {'class': 'pdfemb-inner-div'}).append(
                        $('<canvas></canvas>', {'class': 'pdfemb-the-canvas'})
                    )); //style: 'border:1px solid black',

                divContainer.data('pdfDoc', pdfDoc_);

                var toolbar_location = divContainer.data('toolbar');

                if (toolbar_location != 'bottom') {
                    $.fn.pdfEmbedder.addToolbar(divContainer, true, divContainer.data('toolbar-fixed') == 'on', showIsSecure);
                }

                if (toolbar_location != 'top') {
                    $.fn.pdfEmbedder.addToolbar(divContainer, false, divContainer.data('toolbar-fixed') == 'on', showIsSecure);
                }

                // React to page jump event

                divContainer.on('pdfembGotopage', function(e, pageNum) {
                    if (pageNum > divContainer.data('pdfDoc').numPages || pageNum <= 0 || divContainer.data('pagenum') == pageNum) {
                        return;
                    }

                    divContainer.data('pagenum', pageNum);
                    $.fn.pdfEmbedder.queueRenderPage(divContainer, pageNum);
                    pdfembPremiumJumpToTop(divContainer);

                });

                divContainer.on('pdfembGotoHash', function(e, destobj) {
                    if (!destobj.dest) {
                        return;
                    }
                    dest = destobj.dest;

                    var destinationPromise;
                    if (typeof dest === 'string') {
                        destString = dest;
                        destinationPromise = divContainer.data('pdfDoc').getDestination(dest);
                    } else {
                        destinationPromise = Promise.resolve(dest);
                    }
                    destinationPromise.then(function(destination) {

                        if (!(destination instanceof Array) || destination.length < 1) {
                            return; // invalid destination
                        }

                        divContainer.data('pdfDoc').getPageIndex(destination[0]).then(function (pageIndex) {
                            var pageNum = pageIndex + 1;

                            if (pageNum > divContainer.data('pdfDoc').numPages || pageNum <= 0 || divContainer.data('pagenum') == pageNum) {
                                return;
                            }

                            divContainer.data('pagenum', pageNum);
                            $.fn.pdfEmbedder.queueRenderPage(divContainer, pageNum);
                            pdfembPremiumJumpToTop(divContainer);
                        });

                    });
                });

                divContainer.on('pdfembGotoAction', function(e, action) {
                    var curPage = divContainer.data('pagenum');
                    var newPage = curPage;
                    switch (action) {
                        case 'GoBack':
                            --newPage;
                            break;

                        case 'GoForward':
                            ++newPage;
                            break;

                        case 'NextPage':
                            ++newPage;
                            break;

                        case 'PrevPage':
                            --newPage;
                            break;

                        case 'LastPage':
                            newPage = divContainer.data('pdfDoc').numPages;
                            break;

                        case 'FirstPage':
                            newPage = 1;
                            break;

                        default:
                            break; // No action according to spec
                    }

                    if (newPage == curPage || newPage > divContainer.data('pdfDoc').numPages || newPage <= 0) {
                        return;
                    }

                    divContainer.data('pagenum', newPage);
                    $.fn.pdfEmbedder.queueRenderPage(divContainer, newPage);

                });

                // Initial/first page rendering

                divContainer.data('pageCount', pdfDoc_.numPages);

                if (!divContainer.data('pagenum') || divContainer.data('pagenum') < 1 || divContainer.data('pagenum') > pdfDoc_.numPages) {
                    divContainer.data('pagenum', 1);
                }

                divContainer.data('showIsSecure', showIsSecure);
                divContainer.data('pageNumPending', null);

                var startZoom = parseInt(divContainer.data('startzoom'));
                if (isNaN(startZoom) || startZoom < 20 || startZoom > 500) { startZoom = 100;}
                divContainer.data('zoom', startZoom);
                if (startZoom != 100) {
                    divContainer.find('span.pdfemb-zoom').text(startZoom + '%');
                }

                $.fn.pdfEmbedder.renderPage(divContainer, divContainer.data('pagenum'));

                divContainer.find('span.pdfemb-page-count').text( pdfDoc_.numPages );

                var grabtopan = new pdfembGrabToPan({
                    element: divContainer.find('div.pdfemb-inner-div')[0]});
                divContainer.data('grabtopan', grabtopan);

                $(window).resize(function() {
					setTimeout(function() {
						$.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'));
					}, 100);
                });
            };

	    	var callback = function(pdf, showIsSecure) {

	  	    	  /**
	  	    	   * Asynchronously downloads PDF.
	  	    	   */

                  if (pdf === null) {
                      divContainer.empty().append($('<div></div>', {'class': 'pdfemb-errormsg'}).append(msgnode = $('<span></span>').append(
                          document.createTextNode('Failed to load and decrypt PDF'))));
                      return;
                  }

	  	    	  PDFJS.getDocument(pdf).then(
                      function(pdfDoc_) {
                          initPdfDoc(pdfDoc_, showIsSecure)
                      },
                      function(e) {
						  var msgnode = document.createTextNode(e.message);
						  if (e.name == 'UnexpectedResponseException' && e.status == 0) {
							  msgnode = $('<span></span>').append(
								  document.createTextNode(pdfemb_trans.objectL10n.domainerror+' '))
								  .append($('<a href="https://wp-pdf.com/troubleshooting/#unexpected" target="_blank">'+pdfemb_trans.objectL10n.clickhereinfo+'</a>'));
						  }
                          divContainer.empty().append($('<div></div>', {'class': 'pdfemb-errormsg'}).append(msgnode));
                      }
                  );

	    	};

            if (divContainer.data('pdfDoc')) {
                initPdfDoc(divContainer.data('pdfDoc'), divContainer.data('showIsSecure'));
            }
            else {
                var url = divContainer.attr('data-pdf-url');
                pdfembGetPDF(url, callback);
            }
    	});

    	return this;

    };


    // Set up annotations layer factory
    if (typeof(pdfembPremiumAnnotationsLayerFactory) != 'undefined') {
        $.fn.pdfEmbedder.annotationsLayerFactory = new pdfembPremiumAnnotationsLayerFactory();
    }
    else {
        $.fn.pdfEmbedder.annotationsLayerFactory = {
            createAnnotationsLayerBuilder: function (pageDiv, pdfPage) {
                return null;
            }
        }
    }


    $.fn.pdfEmbedder.checkForResize = function(divContainer) {
		var newheight =	$(window).height();
		var newwidth = $(window).width();

		var oldheight = divContainer.data('checked-window-height');
		var oldwidth = divContainer.data('checked-window-width');

		if (!oldheight || !oldwidth) {
			divContainer.data('checked-window-height', newheight);
			divContainer.data('checked-window-width', newwidth);
		}
		else if (oldheight != newheight || oldwidth != newwidth) {
			$.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'));
			divContainer.data('checked-window-height', newheight);
			divContainer.data('checked-window-width', newwidth);
		}

        if (divContainer.data('fullScreenClosed') != 'true') {
            setTimeout(function () {
                $.fn.pdfEmbedder.checkForResize(divContainer);
            }, 1000);
        }
	};

    $.fn.pdfEmbedder.renderPage = function(divContainer, pageNum, noredraw) {

    	divContainer.data('pageRendering', true);
    	
	    // Using promise to fetch the page
	    var pdfDoc = divContainer.data('pdfDoc');
	    
	    pdfDoc.getPage(pageNum).then(function(page) {

            var canvas = divContainer.find('.pdfemb-the-canvas');
            var canvasImg = null;
            var canvasCxt = null;
            var oldCanvasWidth = null;
            var oldCanvasHeight = null;
            if (noredraw) {
                oldCanvasWidth = canvas.width();
                oldCanvasHeight = canvas.height();
                canvasCxt = canvas[0].getContext('2d');
                canvasImg = canvasCxt.getImageData(0,0,oldCanvasWidth, oldCanvasHeight);
            }

		    var scale = 1.0;
		    
		    var vp = page.getViewport(scale);
		    
		    var pageWidth = vp.width;
		    var pageHeight = vp.height;
		    
		    if (pageWidth <= 0 || pageHeight <= 0) {
		    	divContainer.empty().append(document.createTextNode(pdfemb_trans.objectL10n.widthheightinvalid));
		    	return;
		    }
		    
		    // Max out at parent container width
		    var parentWidth = divContainer.parent().width();
		    
		    var wantWidth = pageWidth;
		    var wantHeight = pageHeight;
		    
		    if (divContainer.data('width') == 'max') {
		    	wantWidth = parentWidth;
		    }
		    else if (divContainer.data('width') == 'auto') {
		    	wantWidth = pageWidth;
		    }
		    else {
		    	wantWidth = parseInt(divContainer.data('width'), 10);
		    	if (isNaN(wantWidth) || wantWidth <= 0) {
		    		wantWidth = parentWidth;
		    	}
		    }
		    
		    if (wantWidth <= 0) {
		    	wantWidth = pageWidth;
		    }
		    
		    // Always max at the parent container width 
		    if (wantWidth > parentWidth && parentWidth > 0) {
		    	wantWidth = parentWidth;
		    }
		    
	    	scale = wantWidth / pageWidth;
	    	wantHeight = pageHeight * scale;

            var fixedToolbars = divContainer.find('div.pdfemb-toolbar-fixed');

			var wantMobile = pdfembWantMobile($, divContainer, wantWidth, userHeight);

			var actualFixedToolbars = wantMobile ? 0 : fixedToolbars.length;

	    	// Height can be overridden by user
	    	var userHeight = parseInt(divContainer.data('height'), 10);
	    	if (isNaN(userHeight) || userHeight <= 0 || userHeight > wantHeight) {
				if (divContainer.data('height') == "auto") { // Mainly for full screen mode
					userHeight = divContainer.parent().height() - actualFixedToolbars * fixedToolbars.height();
				}
				else { // max
					userHeight = wantHeight;
				}
	    	}
	    	
	    	wantWidth = Math.floor(wantWidth);
	    	wantHeight = Math.floor(wantHeight);



		    var zoom = 100;

            var wantCanvasWidth = wantWidth;
            var wantCanvasHeight = wantHeight;

            var canvasHMargin = 0;
            var canvasVMargin = 0;

            if (!wantMobile) {

                zoom = divContainer.data('zoom');

                wantCanvasWidth = wantWidth * zoom / 100;
                wantCanvasHeight = wantHeight * zoom / 100;

                if (wantCanvasWidth < wantWidth) {
                    canvasHMargin = (wantWidth - wantCanvasWidth) / 2;
                }
                if (wantCanvasHeight < userHeight) {
                    canvasVMargin = (userHeight - wantCanvasHeight) / 2;
                }

            }

            var viewport = page.getViewport(scale * zoom / 100);

            // Set values
		      
            if (wantWidth != divContainer.width()) {
                divContainer.width(wantWidth);
            }
			    
            if (divContainer.height() != userHeight) {
                divContainer.height(userHeight + actualFixedToolbars * fixedToolbars.height());
            }

			var innerdiv = divContainer.find('div.pdfemb-inner-div');
            var oldScrollLeft = innerdiv[0].scrollLeft;
            var oldScrollTop = innerdiv[0].scrollTop;

            innerdiv.width(wantWidth);
			innerdiv.height(userHeight);

            var fixedTopToolbars = fixedToolbars.filter('.pdfemb-toolbar-top');
            if (actualFixedToolbars > 0) {
                innerdiv.css('top', fixedTopToolbars.height());
            }


            canvas[0].width = wantCanvasWidth;
            canvas[0].height = wantCanvasHeight;
		      
            canvas.css('width', wantCanvasWidth);
            canvas.css('height', wantCanvasHeight);

            canvas.css('left', canvasHMargin).css('top', canvasVMargin);
		      
            // Need to pan?
		      
            if ((wantCanvasWidth > wantWidth || wantCanvasHeight > wantHeight || wantCanvasHeight > userHeight) && !wantMobile) {


                // Adjust panning offset to ensure a recent zoom change centres the doc?

                var fromZoom = divContainer.data('fromZoom');
                var toZoom = divContainer.data('toZoom');

                if (fromZoom > 0 && toZoom > 0) {

                    var oldMidX = oldScrollLeft + wantWidth / 2;
                    var oldMidY = oldScrollTop + wantHeight / 2;

                    innerdiv.scrollLeft((oldMidX * toZoom / fromZoom) - wantWidth/2);
                    innerdiv.scrollTop((oldMidY * toZoom / fromZoom) - wantHeight/2);
                }

                divContainer.data('grabtopan').activate();
            }
            else {
                if (divContainer.data('fullScreen') == 'on') {
                    divContainer.data('grabtopan').activate();
                }
                else {
                    divContainer.data('grabtopan').deactivate();
                }
              divContainer.find('div.pdfemb-inner-div').scrollLeft(0).scrollTop(0); // reset
            }

            divContainer.data('fromZoom',0).data('toZoom', 0);

            pdfembMakeMobile($, wantMobile, divContainer);

            if (noredraw) {
                divContainer.data('pagenum', pageNum);
                divContainer.data('pageRendering', false);

                var newCanvas = $("<canvas>")
                    .attr("width", canvasImg.width)
                    .attr("height", canvasImg.height)[0];

                newCanvas.getContext("2d").putImageData(canvasImg, 0, 0);

                canvasCxt.scale(wantCanvasWidth/oldCanvasWidth, wantCanvasHeight/oldCanvasHeight);
                canvasCxt.drawImage(newCanvas, 0, 0);

                return;
            }

            // Render PDF page into canvas context
            var ctx = canvas[0].getContext('2d');
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function () {
                divContainer.data('pagenum', pageNum);
                divContainer.data('pageRendering', false);

                // Update page counters
                divContainer.find('div.pdfemb-toolbar .pdfemb-page-num').each(function(i, pageNumDisplay) {
                    var jpageNumDisplay = $(pageNumDisplay);
                    if (jpageNumDisplay.is('span')) {
                        // Normal span area
                        jpageNumDisplay.text(pageNum);
                    } else {
                        // User-changeable text
                        jpageNumDisplay.val(pageNum);
                    }
                });


                if (pageNum < divContainer.data("pageCount")) {
                    divContainer.find('.pdfemb-next').removeAttr('disabled').removeClass('pdfemb-btndisabled');
                }
                else {
                    divContainer.find('.pdfemb-next').attr('disabled','disabled').addClass('pdfemb-btndisabled');
                }

                if (pageNum > 1) {
                    divContainer.find('.pdfemb-prev').removeAttr('disabled').removeClass('pdfemb-btndisabled');
                }
                else {
                    divContainer.find('.pdfemb-prev').attr('disabled','disabled').addClass('pdfemb-btndisabled');
                }

                // Do annotations layer

                var annotationLayer = $.fn.pdfEmbedder.annotationsLayerFactory.createAnnotationsLayerBuilder(divContainer.find('div.pdfemb-inner-div')[0], page);
                if (annotationLayer != null) {
                    divContainer.find('div.pdfembAnnotationLayer').remove();
                    annotationLayer.setupAnnotations(viewport, divContainer.data('newwindow'));
                }

                // End annotations layer

                if (divContainer.data('pageNumPending') !== null) {
                    // New page rendering is pending
                    $.fn.pdfEmbedder.renderPage(divContainer, divContainer.data('pageNumPending'));
                    divContainer.data('pageNumPending', null);
                }
            });


	    });

    };
    
    $.fn.pdfEmbedder.queueRenderPage = function(divContainer, num, noredraw) {
        if (divContainer.data('pageRendering')) {
        	divContainer.data('pageNumPending', num);
        } else {
        	$.fn.pdfEmbedder.renderPage(divContainer, num, noredraw);
        }
      };

    $.fn.pdfEmbedder.goFullScreen = function(divContainer) {
        var fsWindow = $('<div class="pdfemb-fs-window"></div>');
        $(document.body).append(fsWindow);
    };

	$.fn.pdfEmbedder.changeZoom = function(divContainer, zoomdelta) {
		var oldzoom = divContainer.data('zoom');
		var newzoom = oldzoom + zoomdelta;
		divContainer.data('zoom', newzoom);
		divContainer.find('span.pdfemb-zoom').text( newzoom + '%' );

		$.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'));
        divContainer.data('fromZoom', oldzoom).data('toZoom', newzoom);
	};

    $.fn.pdfEmbedder.magnifyZoom = function(divContainer, magnification) {
        var oldzoom = divContainer.data('zoom');
        var newzoom = Math.floor(oldzoom * magnification);

        if (newzoom < 20) {
            newzoom = 20;
        }
        if (newzoom > 500) {
            newzoom = 500;
        }
        divContainer.data('zoom', newzoom);
        divContainer.find('span.pdfemb-zoom').text( newzoom + '%' );

        $.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'), true);
        divContainer.data('fromZoom', oldzoom).data('toZoom', newzoom);

    };
    
    $.fn.pdfEmbedder.addToolbar = function(divContainer, atTop, fixed, showIsSecure){
    	
    	var toolbar = $('<div></div>', {'class': 'pdfemb-toolbar pdfemb-toolbar'+(fixed ? '-fixed' : '-hover')+' '+(atTop ? ' pdfemb-toolbar-top' : 'pdfemb-toolbar-bottom')});
    	var prevbtn = $('<button class="pdfemb-prev" title="'+pdfemb_trans.objectL10n.prev+'"></button>');
    	toolbar.append(prevbtn);
    	var nextbtn = $('<button class="pdfemb-next" title="'+pdfemb_trans.objectL10n.next+'"></button>');
    	toolbar.append(nextbtn);
    	
    	toolbar.append($('<div class="pdfemb-page-area">'+pdfemb_trans.objectL10n.page+' <span class="pdfemb-page-num">0</span> / <span class="pdfemb-page-count"></span></div>'));

		var zoomoutbtn = $('<button class="pdfemb-zoomout" title="'+pdfemb_trans.objectL10n.zoomout+'"></button>');
		toolbar.append(zoomoutbtn);

		var zoominbtn = $('<button class="pdfemb-zoomin" title="'+pdfemb_trans.objectL10n.zoomin+'"></button>');
    	toolbar.append(zoominbtn);

    	toolbar.append($('<div>'+pdfemb_trans.objectL10n.zoom+' <span class="pdfemb-zoom">100%</span></div>'));

    	if (showIsSecure) {
	    	toolbar.append($('<div>'+pdfemb_trans.objectL10n.secure+'</div>'));
	    }
    	
    	if (atTop) {
			divContainer.prepend(toolbar);
    	}
    	else {
			divContainer.append(toolbar);
    	}
    	
    	// Add button functions
    	prevbtn.on('click', function (e){
    	    if (divContainer.data('pagenum') <= 1) {
    	        return;
    	      }
    	    divContainer.data('pagenum', divContainer.data('pagenum')-1);
    	    $.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'));
            pdfembPremiumJumpToTop(divContainer);
    	});

    	nextbtn.on('click', function (e){
    	    if (divContainer.data('pagenum') >= divContainer.data('pdfDoc').numPages) {
    	        return;
    	      }
    	    divContainer.data('pagenum', divContainer.data('pagenum')+1);
    	    $.fn.pdfEmbedder.queueRenderPage(divContainer, divContainer.data('pagenum'));
            pdfembPremiumJumpToTop(divContainer);
    	});

		zoominbtn.on('click', function (e){
    	    if (divContainer.data('zoom') >= 500) {
    	        return;
			}
			$.fn.pdfEmbedder.changeZoom(divContainer, 10);
    	});
    	
    	zoomoutbtn.on('click', function (e){
    	    if (divContainer.data('zoom') <= 20) {
    	        return;
			}
			$.fn.pdfEmbedder.changeZoom(divContainer, -10);
    	});


        pdfembAddMoreToolbar($, toolbar, divContainer);

		if (!fixed) {
			divContainer.on('mouseenter', function (e) {
					var htoolbar = divContainer.find('div.pdfemb-toolbar-hover');
                    if (htoolbar.data('no-hover') !== true) {
                        htoolbar.show();
                    }
				}
			);
			divContainer.on('mouseleave',
				function (e) {
					var htoolbar = divContainer.find('div.pdfemb-toolbar-hover');
					htoolbar.hide();
				}
			);
		}

        // Powered by
        if (pdfemb_trans.poweredby) {
            toolbar.append($('<div></div>',{'class':'pdfemb-poweredby'}).append($('<a href="https://wp-pdf.com/?utm_source=Poweredby&utm_medium=freemium&utm_campaign=Freemium" target="_blank">wp-pdf.com</a>')));
        }
    };

    // Apply plugin to relevant divs
	
	PDFJS.workerSrc = pdfemb_trans.worker_src;
	PDFJS.cMapUrl = pdfemb_trans.cmap_url;
	PDFJS.cMapPacked = true;
	$('.pdfemb-viewer').pdfEmbedder();
	
});

