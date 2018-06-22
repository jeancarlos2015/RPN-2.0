(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-48204277-1', 'auto');
ga('send', 'pageview');

// override analytics stub
function track(category, action, label) {
  ga('send', {
    'hitType': 'event',
    'eventCategory': category,
    'eventAction': action,
    'eventLabel': label
  });
}

(function() {
  var targets = document.querySelectorAll('[data-track]');

  for (var i = 0; i < targets.length; i++) {
    (function(el) {
      var data = el.getAttribute('data-track').split(':');

      el.addEventListener('click', function() {
        track(data[0], data[1], data[2]);
      }, false);
    })(targets[i]);
  }
})();