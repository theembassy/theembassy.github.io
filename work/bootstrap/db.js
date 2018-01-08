console.clear()

/***********************************************************
 * functional.js
 ***********************************************************/
const compose = (...functions) => data =>
  functions.reduceRight((value, func) => func(value), data)

const set = prop => obj => value =>
  (obj[prop] = value, obj)

const map = f => x =>
  Array.prototype.map.call(x, f)

const join = seperator => list =>
  Array.prototype.join.call(list, seperator)

/***********************************************************
 * dom.js
 ***********************************************************/
const setInnerHtml = set('innerHTML')

/***********************************************************
 * html.js
 ***********************************************************/
const encodeAttribute = (x = '') =>
  x.replace(/"/g, '&quot;')

const toAttributeString = (x = {}) =>
  compose(
    join(' '),
    map(attr => `${encodeAttribute(attr)}="${encodeAttribute(x[attr])}"`),
    Object.keys
  )(x)

const tagAttributes = x => (contents = '') =>
  `<${x.tag}${x.attr?' ':''}${toAttributeString(x.attr)}>${contents}</${x.tag}>`

const tag = x =>
  typeof x === 'string'
    ? tagAttributes({ tag: x })
    : tagAttributes(x)

// list-group
const listGroupTag = tag({ tag: 'ul', attr: { class: 'list-group' }})
const listGroupItem = tag({ tag: 'li', attr: { class: 'list-group-item' }})
const listGroupItems = list =>
  list.map(listGroupItem)
    .join('')
const listGroup = compose(listGroupTag, listGroupItems)

// panel
const panelTag = tag({ tag: 'div', attr: { class: 'panel panel-default' }})
const panelBody = tag({ tag: 'div', attr: { class: 'panel-body' }})
const basicPanel = compose(panelTag, panelBody)

const listGroupPanel = compose(basicPanel, listGroup)

/***********************************************************
 * main.js
 ***********************************************************/
const content = document.getElementById('content')
const main = e =>
  compose(setInnerHtml(e), listGroupPanel)

const list = [
  'Cras justo odio',
  'Dapibus ac facilisis in',
  'Morbi leo risus',
  'Porta ac consectetur ac',
  'Vestibulum at eros'
]

main(content)(list)
