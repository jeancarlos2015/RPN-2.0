
var dist = localStorage && localStorage.debug ? '' : '.min';
document.write('<script src="/bpmn/app' + dist + '.js"><\/script>');