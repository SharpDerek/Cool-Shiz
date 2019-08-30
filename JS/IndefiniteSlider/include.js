jQuery(document).ready(function($) {
  var sliderOutput = $('#slider');
  var sliderValue = sliderOutput.sliderRange({
    values: {
      value1: {
        value: 0.20,
        color: '#ff0000',
      },
      value2: {
        value: 0.20,
        color: '#ffff00',
      },
      value3: {
        value: 0.20,
        color: '#00ff00',
      },
      value4: {
        value: 0.20,
        color: '#00ffff',
      },
      value5: {
        value: 0.20,
        color: '#0000ff',
      }  
    }
  });
  
  $('#sliderOutput').html(outputSlidervalue(sliderValue)); // On Page load
  
  sliderOutput.on("sliderChanged", function(event, value) { // On Slider Updated
    $('#sliderOutput').html(outputSlidervalue(value));
  });

  function outputSlidervalue(values) {
    returnMarkup = "";
    for(const key of Object.keys(values)) {
      returnMarkup += `<p>${key}: ${100 * values[key].value}</p>`;
    }
    return returnMarkup;
  }
});
