/* Examples */
(function($) {
  /*
   * Example 4:
   *
   * - solid color fill
   * - custom start angle
   * - custom line cap
   * - dynamic value set
   */
  var c4 = $('.forth.circle');

  c4.circleProgress({
    startAngle: -Math.PI / 2,
    value: 0.0,
    size: 200,
    lineCap: 'round',
    fill: {color: '#ffa500'}
  }).on('circle-animation-progress', function(event, progress, stepValue) {
   $(this).find('strong').text(stepValue.toFixed(2).substr(1))});
  // Let's emulate dynamic value update
  setTimeout(function() { c4.circleProgress('value', 0.7); }, 1000);
  setTimeout(function() { c4.circleProgress('value', 1.0); }, 1100);
  setTimeout(function() { c4.circleProgress('value', 0.0); }, 2100);
  
}) (jQuery);
