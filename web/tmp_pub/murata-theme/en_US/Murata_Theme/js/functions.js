// ----------------------------------------------------------------------------
// primp page - startup stuff
// ----------------------------------------------------------------------------
var primp = {
	page: function() {
		foo('primp.page',1);
		// base loads
		var $navDropdown = $('.navbar .dropdown-menu');
		$navDropdown.find('*').on(
			'click',
			function(e) {
				var $this = $(this);
				if ($this.hasClass('regions-close') || $this.hasClass('buttons-close')) {
					$navDropdown.removeClass('open')
					// site logic to come
				} else {
					e.stopPropagation();
				}
			}
		);
		var $planetRegion = $('.planet-region');
		$planetRegion.data('text',$planetRegion.text());
		var $imgMap = $('.img-map')
		$imgMap.find('area').on(
			'click mouseenter mouseleave focus focusout',
			function(e) {
				var $this = $(this); 
				var text = $this.attr('title');
				if (e.type == 'mouseenter' || e.type == 'focus') {
					$planetRegion.text(text);
				} else if (e.type == 'mouseleave' || e.type == 'focusout') {
					$planetRegion.text($planetRegion.data('text'));
				} else if (e.type == 'click') {
					$planetRegion.text(text).data('text',text + ' selected');
					$imgMap.attr('class','img-map ' + $this.attr('data-parentClass'))
				}
			}
		);
		var $languages = $('.languages a');
		$('.languages a').on(
			'click',
			function() {
				$languages.removeClass('active')
				$(this).addClass('active');
			}
		);
		setDropdownHeight();
		closeNav();
		// page setup
		$('.clickable').clickable();
		$('input, textarea').placeholder();
		// ad-hoc loads
		var templateJS = primp[ $('body')[0].getAttribute('data-templateJS') ];
		if (typeof templateJS == 'function') templateJS();
	},
	loadComplete: function(targetID) {
		foo('primp.loadComplete');
		var $target = $(targetID);
		$target.find('.clickable').clickable();
		$target.find('input, textarea').placeholder();
	},
	homepage: function() {
		foo('primp.homepage',1);
		function goCarousel() {
			$('#carousel').carouFredSel({
				width: '100%',
				items: {
					visible: 3,
					start: -1
				},
				scroll: {
					items: 1,
					duration: 1000,
					timeoutDuration: 3000
				},
				prev: '.carousel-prev',
				next: '.carousel-next'
			});
		}
		goCarousel();
	},
	calendar: function() {
		foo('primp.calendar',1);
		$('.torso .nav-tabs a:first').tab('show');
		// calendarBuilder cribbed from Scott Andrew LePera: http://jszen.blogspot.com/2007/03/how-to-build-simple-calendar-with.html
		var calendarBuilder = {
			dayLabels: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
			monthLabels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
			generateYearHTML: function(year) {
				foo('calendarBuilder.generateYearHTML',1);
				var today = new Date();
				var tabsHTML = '<table class="table months">';
				tabsHTML += '<tr>'
				for(var i = 0; i <= calendarBuilder.monthLabels.length - 1; i++ ){
					var monthName = calendarBuilder.monthLabels[i].slice(0,3);
					tabsHTML += '<th';
					if (today.getMonth() === i) {
						tabsHTML += ' class="active"';
					}
					tabsHTML += '>'
					tabsHTML += '<a href="#' + monthName + year + '" data-toggle="tab">';
					tabsHTML += monthName;
					tabsHTML += '</a>';
					tabsHTML += '</th>';
				}
				tabsHTML += '</tr>'
				tabsHTML += '</table>';
				var yearHTML = '';
				for (var i = 0; i < 12; i++) {
					yearHTML += calendarBuilder.generateMonthHTML(year,i);
				};
				var html = tabsHTML;
				html += '<div class="tab-content">';
				html += yearHTML;
				html += '</div>'
				return html;
			},
			generateMonthHTML: function(year,month) {
				foo('calendarBuilder.generateMonthHTML',1);
				var firstDay = new Date(year, month, 1);
				var startingDay = firstDay.getDay();
				var monthLength = calendarBuilder.daysInMonth[month];
				// leap year
				if (month == 1) { // February
					if((year % 4 == 0 && year % 100 != 0) || year % 400 == 0){
						monthLength = 29;
					}
				}
				var today = new Date();
				var tableHTML = '<div class="tab-pane';
				if (today.getMonth() === month) {
					tableHTML += ' active';
				}
				tableHTML += '" id="' + calendarBuilder.monthLabels[month].slice(0,3) + year + '">';
				tableHTML += '<table class="table days">';
				tableHTML += '<thead>';
				tableHTML += '<tr>';
				for(var i = 0; i <= 6; i++ ){
					tableHTML += '<th>';
					tableHTML += calendarBuilder.dayLabels[i];
					tableHTML += '</th>';
				}
				tableHTML += '</tr>';
				tableHTML += '</thead>'
				tableHTML += '<tbody>'
				tableHTML += '<tr>';
				var day = 1;
				for (var i = 0; i < 9; i++) {
					for (var j = 0; j <= 6; j++) {
						tableHTML += '<td';
						if (day <= monthLength && (i > 0 || j >= startingDay)) {
							tableHTML += ' id="day' + year;
							tableHTML += (month+1<10 ? '0' + (month+1) : (month+1));
							tableHTML += (day<10 ? '0' + day : day);
							tableHTML += '"><span>' + day + '</span>';
							day++;
						} else {
							tableHTML += '>'
						}
						tableHTML += '</td>';
					}
					if (day > monthLength) {
						break;
					} else {
						tableHTML += '</tr>';
						tableHTML += '<tr>';
					}
				}
				tableHTML += '</tr>';
				tableHTML += '</table>';
				tableHTML += '</div>';
				return tableHTML;
			}
		}
		var calendarLoader = {
			loadYear: function(year) {
				foo('calendarLoader.loadYear',1);
				$.ajax({
					dataType: 'json',
					url: '../scripts/calendar-data.json?year=' + year,
					success: function(data) {
						if (data.events.length) {
							calendarLoader.markCalendar(data);
						}
					}
				});
			},
			markCalendar: function(data) {
				foo('calendarLoader.markCalendar',1);
				$.each(
					data.events,
					function(i,elem) {
						var start = elem.start;
						var end = elem.end;
						var title = start.slice(6,8) + ' ' + calendarBuilder.monthLabels[start.slice(4,6)*1-1] + ' ' + start.slice(0,4)
						var startText = start.slice(0,4) + '/' + start.slice(4,6) + '/' + start.slice(6,8);
						var endText = end.slice(0,4) + '/' + end.slice(4,6) + '/' + end.slice(6,8);
						var dateHTML = '<div class="row"><div class="col-xs-12"><h3>' + title + '</h3></div></div>'
						var eventHTML = '<div class="row has-border">';
						if (elem.image != '') {
							eventHTML += '<div class="col-xs-3">';
							eventHTML += '<img src="' + elem.image + '" />';
							eventHTML += '</div>';
							eventHTML += '<div class="col-xs-9">';
						} else {
							eventHTML += '<div class="col-xs-12">';
						}
						eventHTML += '<h4>' + elem.title + '</h4>'
						eventHTML += '<h5>' + startText + ' - ' + endText + '</h5>'
						eventHTML += '<p>' + elem.desc + '</p>'
						eventHTML += '<p><a class="cta-red" href="' + elem.url + '">More info <span class="moonicon-arrow-right fs2"></span></a></p>'
						eventHTML += '</div>';
						eventHTML += '</div>';
						for (var i = start; i <= end; i++) {
							var $cell = $('#day' + i);
							if (!$cell.find('a').length) {
								var $a = $cell.html('<a href="#day' + i + '">' + $cell.find('span').text() + '</a>').find('a');
							} else {
								var $a = $cell.find('a');
							}
							if ($a.data('eventHTML') == undefined) {
								$a.data('eventHTML',dateHTML + eventHTML);
							} else {
								var $a = $cell.find('a');
								$a.data('eventHTML',$a.data('eventHTML') + eventHTML);
							}
							$a.on(
								'click',
								function(e) {
									e.preventDefault();
									var $this = $(this);
									$this.closest('.calendar-element').find('.days .active').removeClass('active');
									$this.addClass('active');
									$('.calendar-event-info').html($this.data('eventHTML'));
								}
							);
						}
					}
				);
			}
		}
		var $eventCalendar = $('.calendar-parent');
		$eventCalendar.find('.dropdown-menu a').on(
			'click',
			function(e) {
				e.preventDefault();
				var $this = $(this);
				var year = $this.text();
				$this.closest('.dropdown').find('a:first').html(year + ' <span class="moonicon-arrow-down fs4 icon-right"></span>')
				$('.calendar-element').html(
					calendarBuilder.generateYearHTML(year)
				);
				var $months = $('.months');
				$months.find('a').on(
					'click',
					function() {
						$months.find('.active').removeClass('active')
						$(this).parent().addClass('active');
					}
				);
				calendarLoader.loadYear(year);
			}
		).first().click();
	},
	myLocalMurata: function() {
		foo('primp.myLocalMurata',1);
		map.create('map-small');
		map.create('map-large');
	},
	map: function() {
		foo('primp.map',1);
		map.create('map-large');
	}
}