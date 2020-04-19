'use strict'

module.exports = exports = function (ctx) {
  for (var i = 1; i < arguments.length; ++i) {
    exports[arguments[i]](ctx)
  }
}

var extras = [
  'description',
  'markdown',
  'display',
  'byGroupAndType',
  'byType',
  'groupName',
  'shortcutIcon',
  'sort',
  'resolveVariables'
]

extras.forEach(function (name) {
  exports[name] = require('./src/' + name)
})
