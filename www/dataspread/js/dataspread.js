function generate_chart(element,data,options)
{
  if(typeof element == "undefined" || element == null)
  {
    console.log('Element is not properly defined.');
    return;
  }
  if(typeof data == "undefined" || data == null)
  {
    console.log('Data is not properly defined');
    return;
  }
  if(typeof options == "undefined" || options == null)
  {
    console.log('Options not defined, assuming defaults');
    options={
      padding:5,
    };
  }

  //create validation for settings here//

  var canvas_w=element.width;
  var canvas_h=element.height;
  var chart_xyone=[options.padding,options.padding];
  var chart_xytwo=[canvas_w-options.padding,canvas_h-options.padding];
  console.log(chart_xytwo);
}
