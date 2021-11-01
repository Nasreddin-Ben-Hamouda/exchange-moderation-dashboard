/*!

 =========================================================
 * Material Dashboard - v2.1.1
 =========================================================

 * Product Page: https://www.creative-tim.com/product/material-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com)

 * Designed by www.invisionapp.com Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

(function() {
  isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

    $('html').addClass('perfect-scrollbar-on');
  } else {
    $('html').addClass('perfect-scrollbar-off');
  }
})();


var breakCards = true;

var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var mobile_menu_visible = 0,
  mobile_menu_initialized = false,
  toggle_initialized = false,
  bootstrap_nav_initialized = false;

var seq = 0,
  delays = 80,
  durations = 500;
var seq2 = 0,
  delays2 = 80,
  durations2 = 500;

$(document).ready(function() {

  $('body').bootstrapMaterialDesign();

  $sidebar = $('.sidebar');

  md.initSidebarsCheck();

  window_width = $(window).width();

  // check if there is an image set for the sidebar's background
  md.checkSidebarImage();

  //    Activate bootstrap-select
  if ($(".selectpicker").length != 0) {
    $(".selectpicker").selectpicker();
  }

  //  Activate the tooltips
  $('[rel="tooltip"]').tooltip();

  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });

  // remove class has-error for checkbox validation
  $('input[type="checkbox"][required="true"], input[type="radio"][required="true"]').on('click', function() {
    if ($(this).hasClass('error')) {
      $(this).closest('div').removeClass('has-error');
    }
  });

});

$(document).on('click', '.navbar-toggler', function() {
  $toggle = $(this);

  if (mobile_menu_visible == 1) {
    $('html').removeClass('nav-open');

    $('.close-layer').remove();
    setTimeout(function() {
      $toggle.removeClass('toggled');
    }, 400);

    mobile_menu_visible = 0;
  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 430);

    var $layer = $('<div class="close-layer"></div>');

    if ($('body').find('.main-panel').length != 0) {
      $layer.appendTo(".main-panel");

    } else if (($('body').hasClass('off-canvas-sidebar'))) {
      $layer.appendTo(".wrapper-full-page");
    }

    setTimeout(function() {
      $layer.addClass('visible');
    }, 100);

    $layer.click(function() {
      $('html').removeClass('nav-open');
      mobile_menu_visible = 0;

      $layer.removeClass('visible');

      setTimeout(function() {
        $layer.remove();
        $toggle.removeClass('toggled');

      }, 400);
    });

    $('html').addClass('nav-open');
    mobile_menu_visible = 1;

  }

});

// activate collapse right menu when the windows is resized
$(window).resize(function() {
  md.initSidebarsCheck();

  // reset the seq for charts drawing animations
  seq = seq2 = 0;

  // setTimeout(function() {
  //   md.initDashboardPageCharts();
  // }, 500);
});

md = {
  misc: {
    navbar_menu_visible: 0,
    active_collapse: true,
    disabled_collapse_init: 0,
  },

  checkSidebarImage: function() {
    $sidebar = $('.sidebar');
    image_src = $sidebar.data('image');

    if (image_src !== undefined) {
      sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';
      $sidebar.append(sidebar_container);
    }
  },

  showNotification: function(from, align) {
    type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    color = Math.floor((Math.random() * 6) + 1);

    $.notify({
      icon: "add_alert",
      message: "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer."

    }, {
      type: type[color],
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  },

  initDocumentationCharts: function() {
    if ($('#signaledProfiles').length != 0 && $('#websiteViewsChart').length != 0) {
      /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

      dataSignaledProfiles = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsSignaledProfiles = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }

      var signaledProfiles = new Chartist.Line('#signaledProfiles', dataSignaledProfiles, optionsSignaledProfiles);

      var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataSignaledProfiles, optionsSignaledProfiles);
    }
  },


  initFormExtendedDatetimepickers: function() {
    $('.datetimepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });

    $('.datepicker').datetimepicker({
      format: 'MM/DD/YYYY',
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });

    $('.timepicker').datetimepicker({
      //          format: 'H:mm',    // use this format if you want the 24hours timepicker
      format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'

      }
    });
  },


  initSliders: function() {
    // Sliders for demo purpose
    var slider = document.getElementById('sliderRegular');

    noUiSlider.create(slider, {
      start: 40,
      connect: [true, false],
      range: {
        min: 0,
        max: 100
      }
    });

    var slider2 = document.getElementById('sliderDouble');

    noUiSlider.create(slider2, {
      start: [20, 60],
      connect: true,
      range: {
        min: 0,
        max: 100
      }
    });
  },

  initSidebarsCheck: function() {
    if ($(window).width() <= 991) {
      if ($sidebar.length != 0) {
        md.initRightMenu();
      }
    }
  },

  checkFullPageBackgroundImage: function() {
    $page = $('.full-page');
    image_src = $page.data('image');

    if (image_src !== undefined) {
      image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
      $page.append(image_container);
    }
  },

  initDashboardPageGroup1Charts : function(dataSignaledProfiles,dataSignaledPosts,dataSignaledComments,dataTopPosts){
    optionsSignaledProfiles = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: Math.max(...dataSignaledProfiles.series[0]) + 10, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      chartPadding: {
        top: 30,
        right: 0,
        bottom: 0,
        left: 0
      },
      axisY: {
        onlyInteger: true
      },
      plugins: [
        Chartist.plugins.tooltip()
      ]
    };

    optionsSignaledPosts = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: Math.max(...dataSignaledPosts.series[0]) + 10, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      chartPadding: {
        top: 30,
        right: 0,
        bottom: 0,
        left: 0
      },
      axisY: {
        onlyInteger: true
      },
      plugins: [
        Chartist.plugins.tooltip()
      ]
    }

    optionsSignaledComments = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: Math.max(...dataSignaledComments.series[0]) + 10, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      chartPadding: {
        top: 30,
        right: 0,
        bottom: 0,
        left: 0
      },
      axisY: {
        onlyInteger: true
      },
      plugins: [
        Chartist.plugins.tooltip()
      ]
    }

    var optionsTopPosts = {
      axisX: {
        showGrid: false
      },
      low: 0,
      high: Math.max(...dataTopPosts.series[0]) + 10,
      chartPadding: {
        top: 30,
        right: 5,
        bottom: 0,
        left: 5
      },
      plugins: [
        Chartist.plugins.tooltip()
      ]
    };

     var signaledProfiles = new Chartist.Line('#signaledProfiles', dataSignaledProfiles, optionsSignaledProfiles);
     md.startAnimationForLineChart(signaledProfiles);

     var signaledPosts = new Chartist.Line('#signaledPosts', dataSignaledPosts, optionsSignaledPosts)
     md.startAnimationForLineChart(signaledPosts);

     var signaledComments = new Chartist.Line('#signaledComments', dataSignaledComments, optionsSignaledComments)
     md.startAnimationForLineChart(signaledComments);


    var topPosts = Chartist.Bar('#topPosts', dataTopPosts, optionsTopPosts);
    md.startAnimationForBarChart(topPosts);
  },
  initDashboardPageGroup2Charts: function(dataInteractions,dataContributors,isPerDayPieChars=false){
    var summation = function(a, b) { return a + b.value };
    var totalInteractions = dataInteractions.series.reduce(summation,0);
    var totalContributions =  dataContributors.series.reduce(summation,0); 
    if(!isPerDayPieChars){
      $("#interactions-total").text("Total d'intéractions  = "+totalInteractions);
      $("#contributors-total").text("Total de contributions = "+totalContributions);
    }else{
      $("#perDay-interactions-total").text("Total d'intéractions dans le jour = "+totalInteractions);
      $("#perDay-contributors-total").text("Total de contributions dans le jour = "+totalContributions);
    }

    var optionsInteraction = {
      labelInterpolationFnc: function(value) {
        return Math.round(value / totalInteractions * 100) + '%';
      },

      plugins: [
         Chartist.plugins.tooltip()
      ]
    }
    var idChart1 = isPerDayPieChars ? "perDayPostsInteraction" : "postsInteraction";
    var idChart2 = isPerDayPieChars ? "perDayExchangeContributors" : "exchangeContributors";

    if(totalInteractions==0){
      $("#"+idChart1).hide();
    }else{
      $("#"+idChart1).show();
      var blogInteraction = new Chartist.Pie("#"+idChart1, dataInteractions,optionsInteraction);
      md.startAnimationForLineChart(blogInteraction);
    }


    var optionsContributors = {
      labelInterpolationFnc: function(value) {
        return Math.round(value / totalContributions * 100) + '%';
      },

      plugins: [
        Chartist.plugins.tooltip()
      ]
    }
    
    if(totalContributions==0){
      $("#"+idChart2).hide();
    }else{
      $("#"+idChart2).show();
      var contributorsChart = new Chartist.Pie('#'+idChart2, dataContributors, optionsContributors);
      md.startAnimationForLineChart(contributorsChart);  
    }
  },

  initDashboardPageCharts: function() {

    if ($('#signaledProfiles').length != 0 || $('#signaledPosts').length != 0 || $('#topPosts').length != 0) {
      /* ----------==========     Daily Sales Chart initialization    ==========---------- */

      dataSignaledProfiles= {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsSignaledProfiles = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
        axisY: {
          onlyInteger: true
        },
        plugins: [
          Chartist.plugins.tooltip()
        ]
      }

      var signaledProfiles = new Chartist.Line('#signaledProfiles', dataSignaledProfiles, optionsSignaledProfiles);

      md.startAnimationForLineChart(signaledProfiles);



      /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

      dataSignaledPosts = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [230, 750, 450, 300, 280, 240, 200],

        ]
      };

      optionsSignaledPosts = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
        axisY: {
          onlyInteger: true
        },
        plugins: [
          Chartist.plugins.tooltip()
        ]
      }

      var signaledPosts = new Chartist.Line('#signaledPosts', dataSignaledPosts, optionsSignaledPosts)
      // start animation for the Completed Tasks Chart - Line Chart
      md.startAnimationForLineChart(signaledPosts);


      var dataSignaledComments = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [11, 0, 3, 4, 5, 7, 40],

        ]
      };

      var optionsSignaledComments = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
        axisY: {
          onlyInteger: true
        },
        plugins: [
          Chartist.plugins.tooltip()
        ]
      }

      var signaledComments = new Chartist.Line('#signaledComments', dataSignaledComments, optionsSignaledComments);
      md.startAnimationForLineChart(signaledComments);


      /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

      var dataTopPosts = {
        labels: ['Mond', 'Tues', 'Wedn', 'Thur', 'Frid', 'Satu', 'Sund'],
        series: [
          [542, 443, 320, 780, 553, 453, 326]

        ]
      };
      var optionsTopPosts = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 5
        },
        plugins: [
          Chartist.plugins.tooltip()
        ]
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var topPosts = Chartist.Bar('#topPosts', dataTopPosts, optionsTopPosts, responsiveOptions);

      //start animation for the Emails Subscription Chart
      md.startAnimationForBarChart(topPosts);



// interactions chart
dataInteractions= {
  series: [
  {
    value: 20,
    meta: 'Metric One'
  }, 
  {
    value: 10,
    meta: 'Metric Two'
  }, 
  {
    value: 70,
    meta: 'Metric Three'
  },
  {
    value: 80,
    meta: 'Metric 4'
  },
  {
    value: 45,
    meta: 'Metric 5'
  },
  {
    value: 75,
    meta: 'Metric 6'
  }
 ]
}
var summation = function(a, b) { return a + b.value };

var optionsInteraction = {
  
  labelInterpolationFnc: function(value) {
    return Math.round(value / dataInteractions.series.reduce(summation,0) * 100) + '%';
  },
  showLabel: true,
  labelOffset: 80,
  chartPadding: 0,
  labelDirection: 'explode',
    plugins: [
    Chartist.plugins.tooltip()
  ]
}


var blogInteraction = new Chartist.Pie('#postsInteraction', dataInteractions,optionsInteraction);
var blogInteractionPerDay = new Chartist.Pie('#perDayPostsInteraction', dataInteractions,optionsInteraction);

md.startAnimationForLineChart(blogInteraction);
md.startAnimationForLineChart(blogInteractionPerDay);


// contributors chart
dataContributors= {
  series: [
    {
      value: 20,
      meta: 'Metric One'
    },
    {
      value: 10,
      meta: 'Metric Two'
    },
    {
      value: 70,
      meta: 'Metric Three'
    },
    {
      value: 80,
      meta: 'Metric 4'
    },
    {
      value: 45,
      meta: 'Metric 5'
    },
    {
      value: 75,
      meta: 'Metric 6'
    }
  ]
};

optionsContributors = {
  labelInterpolationFnc: function(value) {
    return Math.round(value / dataContributors.series.reduce(summation,0) * 100) + '%';
  },
  showLabel: true,
  labelOffset: 80,
  chartPadding: 0,
  labelDirection: 'explode',
    plugins: [
    Chartist.plugins.tooltip()
  ]
}

var contributorsChart = new Chartist.Pie('#exchangeContributors', dataContributors, optionsContributors);
var contributorsChartPerDay = new Chartist.Pie('#perDayExchangeContributors', dataContributors, optionsContributors);


md.startAnimationForLineChart(contributorsChart);
md.startAnimationForLineChart(contributorsChartPerDay);

}
},

  initMinimizeSidebar: function() {

    $('#minimizeSidebar').click(function() {
      var $btn = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;
      } else {
        $('body').addClass('sidebar-mini');
        md.misc.sidebar_mini_active = true;
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
  },

  checkScrollForTransparentNavbar: debounce(function() {
    if ($(document).scrollTop() > 260) {
      if (transparent) {
        transparent = false;
        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
      }
    } else {
      if (!transparent) {
        transparent = true;
        $('.navbar-color-on-scroll').addClass('navbar-transparent');
      }
    }
  }, 17),


  initRightMenu: debounce(function() {
    $sidebar_wrapper = $('.sidebar-wrapper');

    if (!mobile_menu_initialized) {
      $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');

      mobile_menu_content = '';

      nav_content = $navbar.html();

      nav_content = '<ul class="nav navbar-nav nav-mobile-menu">' + nav_content + '</ul>';

      navbar_form = $('nav').find('.navbar-form').get(0).outerHTML;

      $sidebar_nav = $sidebar_wrapper.find(' > .nav');

      // insert the navbar form before the sidebar list
      $nav_content = $(nav_content);
      $navbar_form = $(navbar_form);
      $nav_content.insertBefore($sidebar_nav);
      $navbar_form.insertBefore($nav_content);

      $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {
        event.stopPropagation();

      });

      // simulate resize so all the charts/maps will be redrawn
      window.dispatchEvent(new Event('resize'));

      mobile_menu_initialized = true;
    } else {
      if ($(window).width() > 991) {
        // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
        $sidebar_wrapper.find('.navbar-form').remove();
        $sidebar_wrapper.find('.nav-mobile-menu').remove();

        mobile_menu_initialized = false;
      }
    }
  }, 200),

  startAnimationForLineChart: function(chart) {

    chart.on('draw', function(data) {
      if (data.type === 'line' || data.type === 'area') {
        data.element.animate({
          d: {
            begin: 600,
            dur: 700,
            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
            to: data.path.clone().stringify(),
            easing: Chartist.Svg.Easing.easeOutQuint
          }
        });
      } else if (data.type === 'point') {
        seq++;
        data.element.animate({
          opacity: {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });

    seq = 0;
  },
  startAnimationForBarChart: function(chart) {

    chart.on('draw', function(data) {
      if (data.type === 'bar') {
        seq2++;
        data.element.animate({
          opacity: {
            begin: seq2 * delays2,
            dur: durations2,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });

    seq2 = 0;
  },


  initFullCalendar: function() {
    $calendar = $('#fullCalendar');

    today = new Date();
    y = today.getFullYear();
    m = today.getMonth();
    d = today.getDate();

    $calendar.fullCalendar({
      viewRender: function(view, element) {
        // We make sure that we activate the perfect scrollbar when the view isn't on Month
        if (view.name != 'month') {
          $(element).find('.fc-scroller').perfectScrollbar();
        }
      },
      header: {
        left: 'title',
        center: 'month,agendaWeek,agendaDay',
        right: 'prev,next,today'
      },
      defaultDate: today,
      selectable: true,
      selectHelper: true,
      views: {
        month: { // name of view
          titleFormat: 'MMMM YYYY'
          // other view-specific options here
        },
        week: {
          titleFormat: " MMMM D YYYY"
        },
        day: {
          titleFormat: 'D MMM, YYYY'
        }
      },

      select: function(start, end) {

        // on select we show the Sweet Alert modal with an input
        swal({
            title: 'Create an Event',
            html: '<div class="form-group">' +
              '<input class="form-control" placeholder="Event Title" id="input-field">' +
              '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
          }).then(function(result) {

            var eventData;
            event_title = $('#input-field').val();

            if (event_title) {
              eventData = {
                title: event_title,
                start: start,
                end: end
              };
              $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
            }

            $calendar.fullCalendar('unselect');

          })
          .catch(swal.noop);
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events


      // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
      events: [{
          title: 'All Day Event',
          start: new Date(y, m, 1),
          className: 'event-default'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d - 4, 6, 0),
          allDay: false,
          className: 'event-rose'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d + 3, 6, 0),
          allDay: false,
          className: 'event-rose'
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d - 1, 10, 30),
          allDay: false,
          className: 'event-green'
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d + 7, 12, 0),
          end: new Date(y, m, d + 7, 14, 0),
          allDay: false,
          className: 'event-red'
        },
        {
          title: 'Md-pro Launch',
          start: new Date(y, m, d - 2, 12, 0),
          allDay: true,
          className: 'event-azure'
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          className: 'event-azure'
        },
        {
          title: 'Click for Creative Tim',
          start: new Date(y, m, 21),
          end: new Date(y, m, 22),
          url: 'http://www.creative-tim.com/',
          className: 'event-orange'
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 21),
          end: new Date(y, m, 22),
          url: 'http://www.creative-tim.com/',
          className: 'event-orange'
        }
      ]
    });
  },

  initVectorMap: function() {
    var mapData = {
      "AU": 760,
      "BR": 550,
      "CA": 120,
      "DE": 1300,
      "FR": 540,
      "GB": 690,
      "GE": 200,
      "IN": 200,
      "RO": 600,
      "RU": 300,
      "US": 2920,
    };

    $('#worldMap').vectorMap({
      map: 'world_mill_en',
      backgroundColor: "transparent",
      zoomOnScroll: false,
      regionStyle: {
        initial: {
          fill: '#e4e4e4',
          "fill-opacity": 0.9,
          stroke: 'none',
          "stroke-width": 0,
          "stroke-opacity": 0
        }
      },

      series: {
        regions: [{
          values: mapData,
          scale: ["#AAAAAA", "#444444"],
          normalizeFunction: 'polynomial'
        }]
      },
    });
  }
}

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
};