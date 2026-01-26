/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/pages/echarts.init.js ***!
  \********************************************/
var _option;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Echarts Init Js File
*/
// get colors array from the string
function getChartColorsArray(chartId) {
  if (document.getElementById(chartId) !== null) {
    var colors = document.getElementById(chartId).getAttribute("data-colors");
    colors = JSON.parse(colors);
    return colors.map(function (value) {
      var newValue = value.replace(" ", "");

      if (newValue.indexOf(",") === -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
        if (color) return color;else return newValue;
        ;
      } else {
        var val = value.split(',');

        if (val.length == 2) {
          var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
          rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
          return rgbaColor;
        } else {
          return newValue;
        }
      }
    });
  }
}

//Active Queues Chart
var active_queueDom_p = document.getElementById('active_queue_chart_p');
var myActive_queueChart_p = echarts.init(active_queueDom_p);
var option;
option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    bottom:"bottom",
    padding: 0,
    itemGap: 1,
    left:'center',
    itemWidth: 3,
    textStyle: {
      fontSize: '8',
    },
  },
  series: [
    {
      name: 'Active Queue',
      type: 'pie',
      radius: ['40%', '60%'],
      avoidLabelOverlap: false,
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: false,
          fontSize: '12',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Avl' },
        { value: 735, name: 'Que' },
        { value: 580, name: 'Hold' }
      ]
    }
  ]
};
option && myActive_queueChart_p.setOption(option); // Basic Scatter Chart

//Active Queues Chart
var active_queueDom_s = document.getElementById('active_queue_chart_s');
var myActive_queueChart_s = echarts.init(active_queueDom_s);
var option;
option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    bottom:"bottom",
    padding: 0,
    itemGap: 1,
    left:'center',
    itemWidth: 3,
    textStyle: {
      fontSize: '8',
    },
  },
  series: [
    {
      name: 'Active Queue',
      type: 'pie',
      radius: ['40%', '60%'],
      avoidLabelOverlap: false,
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: false,
          fontSize: '12',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Avl' },
        { value: 735, name: 'Que' },
        { value: 580, name: 'Hold' }
      ]
    }
  ]
};
option && myActive_queueChart_s.setOption(option); // Basic Scatter Chart

//Active Queues Chart
var active_queueDom_k = document.getElementById('active_queue_chart_k');
var myActive_queueChart_k = echarts.init(active_queueDom_k);
var option;
option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    bottom:"bottom",
    padding: 0,
    itemGap: 1,
    left:'center',
    itemWidth: 3,
    textStyle: {
      fontSize: '8',
    },
  },
  series: [
    {
      name: 'Active Queue',
      type: 'pie',
      radius: ['40%', '60%'],
      avoidLabelOverlap: false,
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: false,
          fontSize: '12',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Avl' },
        { value: 735, name: 'Que' },
        { value: 580, name: 'Hold' }
      ]
    }
  ]
};
option && myActive_queueChart_k.setOption(option); // Basic Scatter Chart

//Active Queues Chart AJK
var active_queueDom_a = document.getElementById('active_queue_chart_a');
var myActive_queueChart_a = echarts.init(active_queueDom_a);
var option;
option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    bottom:"bottom",
    padding: 0,
    itemGap: 1,
    left:'center',
    itemWidth: 3,
    textStyle: {
      fontSize: '8',
    },
  },
  series: [
    {
      name: 'Active Queue',
      type: 'pie',
      radius: ['40%', '60%'],
      avoidLabelOverlap: false,
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: false,
          fontSize: '12',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Avl' },
        { value: 735, name: 'Que' },
        { value: 580, name: 'Hold' }
      ]
    }
  ]
};
option && myActive_queueChart_a.setOption(option); // Basic Scatter Chart




//live calls chart Top 3 


//Hourly Calls Chart


//Calls by location graph


})();
