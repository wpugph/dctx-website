'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _slicedToArray2 = require('babel-runtime/helpers/slicedToArray');

var _slicedToArray3 = _interopRequireDefault(_slicedToArray2);

var _chromaJs = require('chroma-js');

var _chromaJs2 = _interopRequireDefault(_chromaJs);

var _swig = require('swig');

var _swigExtras = require('swig-extras');

var _swigExtras2 = _interopRequireDefault(_swigExtras);

var _filters = require('swig/lib/filters');

var _filters2 = _interopRequireDefault(_filters);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var swig = new _swig.Swig();
exports.default = swig;


_swigExtras2.default.useFilter(swig, 'split');
_swigExtras2.default.useFilter(swig, 'trim');
_swigExtras2.default.useFilter(swig, 'groupby');

var safe = function safe(fn) {
  return (fn.safe = true) && fn;
};

var isColor = function isColor(value) {
  try {
    (0, _chromaJs2.default)(value);
    return true;
  } catch (e) {
    return false;
  }
};

var displayAsType = function displayAsType(input) {
  return input.split('|').map(function (x) {
    return x.trim();
  }).map(_filters2.default.capitalize).join('</code> or <code>');
};

var yiq = function yiq(_ref) {
  var _ref2 = (0, _slicedToArray3.default)(_ref, 3),
      red = _ref2[0],
      green = _ref2[1],
      blue = _ref2[2];

  return (red * 299 + green * 587 + blue * 114) / 1000;
};

var yiqContrast = function yiqContrast(rgb) {
  return yiq(rgb) >= 128 ? '#000' : '#fff';
};

var getChannel = function getChannel(start, hex) {
  return parseInt(hex.substr(start, 2), 16);
};

var hexToRgb = function hexToRgb(hex) {
  return [0, 2, 4].map(function (x) {
    return getChannel(x, hex);
  });
};

var colorToHex = function colorToHex(color) {
  return (0, _chromaJs2.default)(color).hex().substr(1);
};

var pluralize = function pluralize(input) {
  return input.toLowerCase().substring(input.length - 1) === 's' ? input : input + 's';
};

// Prevent escaping chars from being printed.
// See sassdoc/sassdoc#531
var unescape = function unescape(input) {
  return input.replace(/\\/g, '');
};

/**
 * Normalises a CSS color, then uses the YIQ algorithm to get the
 * correct contrast.
 *
 * @param {String} color
 * @return {String} `#000` or `#fff` depending on which one is a better.
 * @see {@link http://stackoverflow.com/questions/11867545/change-text-color-based-on-brightness-of-the-covered-background-area}
 */
var maybeYiqContrast = function maybeYiqContrast(color) {
  return isColor(color) ? yiqContrast(hexToRgb(colorToHex(color))) : '#000';
};

swig.setFilter('in', function (key, object) {
  return key in object;
});
swig.setFilter('is_color', isColor);
swig.setFilter('display_as_type', safe(displayAsType));
swig.setFilter('yiq', maybeYiqContrast);
swig.setFilter('pluralize', pluralize);
swig.setFilter('unescape', unescape);