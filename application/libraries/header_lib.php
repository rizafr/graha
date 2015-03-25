<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header_lib{
	
	function login_header()
	{
		$obj =& get_instance();
		$script = '
		<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<noscript><meta http-equiv="refresh" content="0;url='.base_url().'denied/noscript"></noscript>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Graha Raya</title>
		<link rel="shortcut icon" type="image/x-icon" href="'.base_url().'files/images/favicon.ico" />
		<script type="text/javascript" src="'.base_url().'files/js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="'.base_url().'files/css/main.css" />
		<script type="text/javascript">
			var base_url = "'.base_url().'";
		</script>
		';

		return $script;
	}
	
	function dashboard_header()
	{
		$obj =& get_instance();
		$script = '
		<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<noscript><meta http-equiv="refresh" content="0;url='.base_url().'denied/noscript"></noscript>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Graha Raya</title>
		<link rel="shortcut icon" type="image/x-icon" href="'.base_url().'files/images/favicon.ico" />
		<script type="text/javascript" src="'.base_url().'files/js/jquery.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/accounting.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/base64.js"></script>
		<link type="text/css" rel="stylesheet" href="'.base_url().'files/css/dashboard.css" />
		<link type="text/css" rel="stylesheet" href="'.base_url().'files/css/tabs.css" />
		<link type="text/css" rel="stylesheet" href="'.base_url().'files/css/blitzer/jquery-ui-1.8.23.custom.css" />
		<link type="text/css" rel="stylesheet" href="'.base_url().'files/css/lightbox/lightbox.css" />
		<script type="text/javascript" src="'.base_url().'files/js/jquery.maphilight.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/mootools-core-1.4.5-compat.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/mootools-more-1.4.0.1-compat.js"></script>
		<script type="text/javascript" src="'.base_url().'files/js/lightbox.js"></script>
		<script type="text/javascript">
			var base_url = "'.base_url().'";
			
			function isUndefined(x, y){
				if (x === undefined){
					return y;
				}
				else{
					return x;
				}
			}
			
			function fm(n){return accounting.formatMoney(n, "", 0,",",".");}
			function fm2(n){return accounting.formatMoney(n, "", 2,",",".");}
			function fm10(n){return accounting.formatMoney(n, "", 9,",",".");}
			function ufm(n){return accounting.unformat(n);}

			(function(){

				Drag.Scroll = new Class({
					Implements: [Options],
					options: {
						friction: 5,
						axis: {x: true, y: true}
					},

					initialize: function(element, options){
						element = this.element = document.id(element);
						this.content = element.getFirst();
						this.setOptions(options);

						var prevTime, prevScroll, speed, scroll, timer;
						var timerFn = function(){
							var now = Date.now();
							scroll = [element.scrollLeft, element.scrollTop];
							if (prevTime){
								var dt = now - prevTime + 1;
								speed = [ 1000 * (scroll[0] - prevScroll[0]) / dt, 1000 * (scroll[1] - prevScroll[1]) / dt ];
							}
							
							prevScroll = scroll;
							prevTime = now;
						};

						var fx = this.fx = new Fx.Scroll(element, {transition: Fx.Transitions.Expo.easeOut});

						fx.set.apply(fx, this.limit(element.scrollLeft, element.scrollTop));
						
						var self = this;
						friction = this.options.friction,
						axis = this.options.axis;

						var drag = this.drag = new Drag(element, {
							style: false,
							invert: true,
							modifiers: {x: axis.x && \'scrollLeft\', y: axis.y && \'scrollTop\'},
							onStart: function(){
							
								timerFn();
								timer = setInterval(timerFn, 1000 / 60);
								
								fx.cancel();
							},
							
							onComplete: function(){
							
								prevTime = false;
								clearInterval(timer);
								
								fx.start.apply(fx, self.limit(
									scroll[0] + (speed[0] || 0) / friction,
									scroll[1] + (speed[1] || 0) / friction
								));
							}
						});

						},

					getLimit: function(){
						var limit = [[0, 0], [0, 0]], element = this.element;
						var styles = Object.values(this.content.getStyles(
							\'padding-left\', \'border-left-width\', \'margin-left\',
							\'padding-top\', \'border-top-width\', \'margin-top\',
						\'width\', \'height\'
						)).invoke(\'toInt\');
						limit[0][0] = sum(styles.slice(0, 3));
						limit[0][1] = styles[6] + limit[0][0] - element.clientWidth;
						limit[1][0] = sum(styles.slice(3, 6));
						limit[1][1] = styles[7] + limit[1][0] - element.clientHeight;
						return limit;
					},

					limit: function(x, y){
						var limit = this.getLimit();
						return [ x.limit(limit[0][0], limit[0][1]), y.limit(limit[1][0], limit[1][1]) ];
					}

				});

				var sum = function(array){
					var result = 0;
					for (var l = array.length; l--;) result += array[l];
					return result;
				};

			})();
			
		</script>
		';

		return $script;
	}

}

# End of file access_lib.php
# Location: ./applicaion/libraries/access_lib.php