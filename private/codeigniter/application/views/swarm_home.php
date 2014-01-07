<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>swarm tv</title>
        <script src="<?php echo base_url(); ?>js/vendor/jquery-1.8.3.min.js"></script>
        <style type="text/css">
            html, body {
                width:100%;
                height:100%;
                padding:0px;
                overflow:hidden;
                background-color:#000022;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                color: #ccc;
                font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
                font-size: 1em
            }
        }
        #the-swarm {}
		
        #the-swarm.linkable {
            cursor:pointer;
        }
        #arbor {
            position:absolute;
            min-height:100%;
            min-width:100%;
        }

		A:link {
		  color:#c90;
		  font-weight:bold;
		  text-decoration:none;
		}
		
		A:visited {
		  color:#960;
		  font-weight:bold;
		  text-decoration:none;
		}
		
		A:hover {
		  color:#fc3;
		  font-weight:bold;text-decoration:none;
		}
        </style>
    </head>
    
    <body>
        <div style="padding:20px;">
            <a href="../../pages/view/<?php echo $group; ?>/Home">Home</a>&nbsp;|&nbsp;<a href="../../recentChanges">Recent Changes</a>&nbsp;|&nbsp;<a href="http://ucfmediacentre.co.uk/swarmtv/stream/">Live Stream</a>&nbsp;|&nbsp;<a href="../../pages/view/<?php echo $group; ?>/Shortcodes">Shortcodes</a>&nbsp;|&nbsp;<a href="../../pages/view/<?php echo $group; ?>/Help">Help</a>
			<form action="" method="get" enctype="multipart/form-data" class="hidden" id="filter_form">
                <br /><input name="filter" value="<?php echo $filter; ?>" onchange="submit();" />
				<input type="hidden" value="<?php echo $group; ?>" name="group" />
                <input type="submit" value="Search Filter"><span id="search_results" > (<?php echo $searchResults; ?>) </span>
            </form></div><br /><br />
			<div id="oldBrowser" style="display:none" width="600px">This website is a project designed to work with <strong>HTML5</strong>, so please download a modern browser if you can (its worth the wait - honest!). If you haven't got IT permissions to do this, try Chrome portable (<a href="http://portableapps.com/apps/internet/google_chrome_portable">Chrome Portable</a>). You should be able to use that, OK. Otherwise, go straight to the home page here: <a href="http://ucfmediacentre.co.uk/swarmtv/index.php/pages/view/<?php echo $group; ?>/home">Home</a>, and have a play around there. Thanks very much!<br /><br /><?php echo $listview; ?></div>
        <canvas class="" style="opacity: 1; display: inline;" id="the-swarm" width="1680" height="350"></canvas>
        <img id="bg" src="<?php echo base_url(); ?>img/default_background.jpg" style="display:none;" />
        <script src="<?php echo base_url(); ?>libraries/arbor/lib/arbor.js"></script>
        <script src="<?php echo base_url(); ?>libraries/arbor/lib/arbor-tween.js"></script>
        <script src="<?php echo base_url(); ?>libraries/arbor/lib/arbor-graphics.js"></script>
        <script type="text/javascript">
            (function ($) {
				
				if( !window.Worker) {
					$("#oldBrowser").css("display", "inline");
				} 

                var Renderer = function (elt) {
                    var dom = $(elt)
                    var canvas = dom.get(0)
                    var ctx = canvas.getContext("2d");
                    var gfx = arbor.Graphics(canvas);
                    var sys = null;
                    var img = document.getElementById("bg"); //from Al's coding

                    var selected = null,
                        nearest = null,
                        _mouseP = null;


                    var that = {
                        init: function (pSystem) {
                            sys = pSystem
                            sys.screen({
                                size: {
                                    width: dom.width(),
                                    height: dom.height()
                                },
                                padding: [36, 150, 150, 150]
                            })

                            $(window).resize(that.resize)
                            that.resize()
                            that._initMouseHandling()

                        },
                        resize: function () {
                            canvas.width = $(window).width()
                            canvas.height = $(window).height()
                            sys.screen({
                                size: {
                                    width: canvas.width - 50,
                                    height: canvas.height - 50
                                }
                            })
                            that.redraw()
                        },
                        redraw: function () {
                            gfx.clear()
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height); //from Al's code
                            sys.eachEdge(function (edge, p1, p2) {
                                gfx.line(p1, p2, {
                                    stroke: "silver",
                                    width: 2
                                });
                            })
                            sys.eachNode(function (node, pt) {
                                var w = Math.max(20, 20 + gfx.textWidth(node.name))
                                gfx.rect(pt.x - w / 2, pt.y - 8, w, 20, 4, {
                                    fill: '#000022',
                                    width: 2,
									stroke: node.data.stroke
                                });
                                //gfx.rect(pt.x-w/2, pt.y-8, w, 20, 4, {});
                                //gfx.text(node.name, pt.x, pt.y+5, {color:"orange", align:"center", font:"Arial", size:12});
                                gfx.text(node.name, pt.x, pt.y + 7, {
                                    color: "orange",
                                    align: "center",
                                    font: "Arial",
                                    size: 12
                                });
                            })
                        },


                        _initMouseHandling: function () {
                            // no-nonsense drag and drop (thanks springy.js)
                            selected = null;
                            nearest = null;
                            var dragged = null;
                            var oldmass = 1

                            var _section = null

                            var handler = {
                                moved: function (e) {
                                    var pos = $(canvas).offset();
                                    _mouseP = arbor.Point(e.pageX - pos.left, e.pageY - pos.top)
                                    nearest = sys.nearest(_mouseP);

                                    if (!nearest.node) return false

                                    if (nearest.node.data.shape != 'dot') {
                                        selected = (nearest.distance < 50) ? nearest : null
                                        if (selected) {
                                            dom.addClass('linkable')
                                            window.status = selected.node.data.link.replace(/^\//, "http://" + window.location.host + "/").replace(/^#/, '')
                                        } else {
                                            dom.removeClass('linkable')
                                            window.status = ''
                                        }
                                    }

                                    return false
                                },
                                clicked: function (e) {
                                    var pos = $(canvas).offset();
                                    _mouseP = arbor.Point(e.pageX - pos.left, e.pageY - pos.top)
                                    nearest = dragged = sys.nearest(_mouseP);

                                    if (nearest && selected && nearest.node === selected.node) {
                                        var link = selected.node.data.link
                                        if (link.match(/^#/)) {
                                            $(that).trigger({
                                                type: "navigate",
                                                path: link.substr(1)
                                            })
                                        } else {
                                            window.location = link
                                        }
                                        return false
                                    }


                                    if (dragged && dragged.node !== null) dragged.node.fixed = true

                                    $(canvas).unbind('mousemove', handler.moved);
                                    $(canvas).bind('mousemove', handler.dragged)
                                    $(window).bind('mouseup', handler.dropped)

                                    return false
                                },
                                dragged: function (e) {
                                    var old_nearest = nearest && nearest.node._id
                                    var pos = $(canvas).offset();
                                    var s = arbor.Point(e.pageX - pos.left, e.pageY - pos.top)

                                    if (!nearest) return
                                    if (dragged !== null && dragged.node !== null) {
                                        var p = sys.fromScreen(s)
                                        dragged.node.p = p
                                    }

                                    return false
                                },

                                dropped: function (e) {
                                    if (dragged === null || dragged.node === undefined) return
                                    if (dragged.node !== null) dragged.node.fixed = false
                                    dragged.node.tempMass = 1000
                                    dragged = null;
                                    // selected = null
                                    $(canvas).unbind('mousemove', handler.dragged)
                                    $(window).unbind('mouseup', handler.dropped)
                                    $(canvas).bind('mousemove', handler.moved);
                                    _mouseP = null
                                    return false
                                }


                            }

                            $(canvas).mousedown(handler.clicked);
                            $(canvas).mousemove(handler.moved);

                        }
                    }

                    return that
                }

                $(document).ready(function () {

                    var links = <?php echo $links; ?> ;
					var strokeColour
					var UIstring = '';
					var edgeString = '';
					var nodeString = '';
					var edge = '';
					var pagesFound = new Array();;
					// create an array of just the pages found
					for (var i = 0; i < links.length; i++) {
					  pagesFound.push(links[i].title);
					}
					//iterate through the list of pages again and this time extract the edges needed
					for (var i = 0; i < links.length; i++) {
						strokeColour = '';
						//check to see if any pages have links
						if (links[i].link_tree.length > 0) {
							//create a string to represent each node(page) from which the edges(links) are to be drawn
							edgeString = edgeString + '"' + links[i].title + '":{';
							//search through all the links tree for the page to create the connections
							for (var j = 0; j < links[i].link_tree.length; j++) {
								edge = links[i].link_tree[j].linkTitle;
								
								//check to see that all nodes are in the pages found array
								for(var k=0;k<pagesFound.length;k++) {
									if(edge.toUpperCase() == pagesFound[k].toUpperCase()) {
										edgeString = edgeString + '"' + pagesFound[k] + '":{},'
									}
								}
							}
							//take off end comma if there were some edges found
							//otherwise it will leave the starting bracket by default
							if (edgeString.charAt(edgeString.length-1) == ","){
							  edgeString = edgeString.substr(0,edgeString.length-1);  
							}
							//terminate the object properly
							edgeString = edgeString + '},';
						}
						//build up the node string with title & link
						nodeString = nodeString + '"' + links[i].title;
						nodeString = nodeString + '":{"link":"<?php echo base_url(); ?>index.php/pages/view/'+ '<?php echo $group; ?>/' + links[i].title + '", ';
						//create a stroke colour but leave it blank for now
						nodeString = nodeString + '"stroke":""},';
						
					}
					//take off the end comas
					nodeString = nodeString.substr(0,nodeString.length-1);
					edgeString = edgeString.substr(0,edgeString.length-1);
					//construct the UIstring
					UIstring = '{"nodes":{';
					UIstring = UIstring + nodeString;
					UIstring = UIstring + '}, "edges":{';
					UIstring = UIstring + edgeString;
					UIstring = UIstring + '}}';
					var theUI = $.parseJSON(UIstring);
					
					// see how many times each page occurs across the edges(links) section of the array
					var node = "";
					var count
					var connections = new Array();
					$.each(theUI.edges, function(page, links) {
						$.each(links, function(item, value){
							connection = page+"°"+item;
							if($.inArray(connection, connections) < 0){
								//if this connection isnt already in the array then store it 
								connections.push(connection);
								//also store the reverse connection!
								connection = item+"°"+page;
								connections.push(connection);
							}
						})
					});
					
					var nodeNum = 0;
					$.each(theUI.nodes, function(key, value) {
						count=0;
						for (var m=0; m<connections.length; m++) {
							if (key === connections[m].split("°")[1]){
							  count++;
							}
						}
						if(count>2){
							this.stroke = "white";
						}
					});
					
					/*theUI.nodes["Recent Changes"].stroke = "cyan";
					theUI.nodes["Recent Changes"].link = "<?php echo base_url(); ?>index.php/recentChanges";
					theUI.nodes["Stream"].stroke = "cyan";
					theUI.nodes["Stream"].link = "<?php echo base_url(); ?>stream";*/
					
                    var sys = arbor.ParticleSystem();
                    sys.parameters({
                        stiffness: 900,
                        repulsion: 2000,
                        gravity: true,
                        dt: 0.015
                    })
					if (pagesFound.length === 1) {
						//Stop single nodes bouncing all over the place
						sys.parameters({ friction: '10.0' });
						sys.parameters({gravity:true, dt:0.0001}) 
					}
					
                    sys.renderer = Renderer("#the-swarm");
                    sys.graft(theUI);

                })
            })(this.jQuery)
        </script>
    </body>

</html>