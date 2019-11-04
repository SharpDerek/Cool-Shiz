jQuery.fn.extend({
  'sliderRange': function(settings = {}) {
    $ = jQuery;
    let base = $(this);
    let output = {};
    let interactions = [];

    function colorSlider() {
      if (settings.hasOwnProperty('values')) {
        for (const key of Object.keys(settings.values)) {
          let colornode = base.find(`.slider-color-node[color-value="${key}"]`);
          if (colornode.length <= 0) {
            colornode = $(`<div class="slider-color-node" color-value="${key}"></div>`);
            base.prepend(colornode);
          }
          colornode.css({
            position: 'absolute',
            top: 0,
            bottom: 0,
            left: trygetvalue(key, 'rightvalue', 0, base.width()),
            width: trygetvalue(key, 'leftvalue', 0, base.width()) - trygetvalue(key, 'rightvalue', 0, base.width()),
            zIndex: 0,
            borderRadius: '50px',
            background: settings.values[key].color
          })
        }
      }
    }

    function reorder(handle) {
      let handleindex = handle.attr("handleindex");
      interactions.push(
        interactions.includes(handleindex) ?
        interactions.splice(
          interactions.indexOf(handleindex),
          1
        )[0] : handleindex
      );
      return interactions.indexOf(handleindex);
    }

    function clamp(num, min, max) {
      return num <= min ? min : num >= max ? max : num;
    }
    function trygetvalue(value, valuetype, min, max) {
      let fallback = 0;
      switch (valuetype) {
        case 'rightvalue':
        fallback = min;
        break;
        case 'leftvalue':
        fallback = max;
        break;
      }
      let query = $(`.slider-handle[${valuetype}="${value}"]`) 
      if (query.length <= 0) {
        return fallback;
      } else {
        return query.eq(0).position().left;
      }
    }

    function dragHandle(handle) {
      var pos1 = 0;
      var pos3 = 0;
      handle.on('touchstart mousedown', function(e) {
        e = e || window.event;
        e.preventDefault();
        pos3 = e.clientX || e.touches[0].clientX;

        handle.css({
          zIndex: reorder(handle)
        });
        base.find('.slider-handle').each(function() {
          $(this).css({
            zIndex: interactions.indexOf($(this).attr("handleindex"))
          });
        });

        $(document).on('touchend mouseup mouseleave', function() {
          closeDragElement();
        });
        $(document).on('touchmove mousemove', function() {
          elementDrag();
        })
      });

      function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        let clientX =  e.clientX || e.touches[0].clientX
        pos1 = pos3 - clientX;
        pos3 = clientX;
        handle.css({
          left: `${clamp(
            handle.position().left - pos1,
            trygetvalue(handle.attr("leftvalue"),
              "rightvalue",
              0,
              handle.parent().width()
            ),
            trygetvalue(
              handle.attr("rightvalue"),
              "leftvalue",
              0,
              handle.parent().width()
            )
          )}px`
        });

        output[handle.attr("leftvalue")].value = (
          handle.position().left - trygetvalue(
            handle.attr("leftvalue"),
            "rightvalue",
            0,
            handle.parent().width()
          )
        )/handle.parent().width();

        output[handle.attr("rightvalue")].value = (
          trygetvalue(
            handle.attr("rightvalue"),
            "leftvalue",
            0,
            handle.parent().width()
          ) - handle.position().left
        )/handle.parent().width();

        handle.attr("handleposition", handle.position().left);

        base.trigger("sliderChanged", [output]);
        colorSlider();
      }

      function closeDragElement() {
        $(document).unbind("mouseup touchend").unbind("mousemove touchmove");
      }
    }

    base.css({
      width: "100%",
      minHeight: "10px",
      backgroundColor: "#ddd",
      position: "relative",
      borderRadius: "50px",
      border: "1px solid #aaa"
    });
    if (settings.hasOwnProperty('values')) {
      output = settings.values;
      let priorValues = 0;
      let index = 0;
      for(const key of Object.keys(settings.values)) {
        if (index < Object.keys(settings.values).length - 1) {
          const handle = $('<div class="slider-handle"><span></span></div>');
          priorValues += 100 * settings.values[key].value;
          handle.attr({
            leftvalue: Object.keys(settings.values)[index],
            rightvalue: Object.keys(settings.values)[index+1],
            handleindex: index
          }).css({
            position: 'absolute',
            zIndex: reorder(handle),
            left: `${priorValues}%`,
            cursor: 'pointer',
            height: "100%"
          })
          .appendTo(base)
          .find('span')
          .css({
            top: "-5px",
            bottom: "-5px",
            width: "15px",
            display: "block",
            background: "#eee",
            border: "1px solid #aaa",
            borderRadius: "4px",
            position: "absolute",
            left: 0,
            transform: "translateX(-50%)"
          });
          handle.attr("handleposition", handle.position().left)
          dragHandle(handle);
          index++;
        }
      }
      base.trigger("sliderInit", [output]);
      colorSlider();
      $(window).on('resize', function() {
        colorSlider();
      });
      base.on("colorSlider", function() {
        colorSlider();
      });
      return output;
    }
    return new Error("No values defined");
  }
});
