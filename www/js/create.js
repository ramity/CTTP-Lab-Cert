window.selected_key_array=[];
window.selected_val_array=[];

window.selected_array=[];
window.select_display=false;

window.conv_array=[];

window.keystatus=[];
window.keystatus['K']=false;
window.keystatus['V']=false;
window.keystatus['LMOUSE']=false;
window.keystatus['CTRL']=false;

window.canvas_clicked=false;

$(document).mousedown(function(){window.keystatus['LMOUSE']=true;
}).mouseup(function(){window.keystatus['LMOUSE']=false;});

kd.run(function(){kd.tick();});

kd.K.down(function(){window.keystatus['K']=true;});
kd.K.up(function(){window.keystatus['K']=false;});

kd.V.down(function(){window.keystatus['V']=true;});
kd.V.up(function(){window.keystatus['V']=false;});

kd.ENTER.down(function(){});

$(document).on('scroll','canvas#container',function(){
  console.log('Event Fired');
});

$(function()
{
  $('canvas#container').css('background-color','#fff');

  $('canvas#container').click(function(e)
  {
    window.canvas_clicked=true;

    window.canvas_mouse_x = e.pageX - this.offsetLeft;
    window.canvas_mouse_y = e.pageY - this.offsetTop;

    console.log(canvas_mouse_x,canvas_mouse_y);

    draw();
  });

  draw();
});

$(window).resize(function()
{
  console.log('resizing...')
  draw();
  console.log('...done')
});

function draw()
{
  if(conv_array.length)
  {
    canvas = $('canvas#container');
    canvas_container = $('div#canvas_container');

    ctx = $("canvas#container").get(0).getContext('2d');

    reset();

    canvas_width = $('body').innerWidth();
    canvas_height = $(window).height()-155;

    if(col_widths.length)
    {

    }

    canvas.attr('width',canvas_width+'px');
    canvas.attr('height',canvas_height+'px');

    canvas.css('width',canvas_width);
    canvas.css('height',canvas_height);

    scroll_distance_x=25;
    scroll_distance_y=25;

    cell_width = 100;
    cell_height = 25;

    cell_col_header_width = cell_width;
    cell_col_header_height = cell_height;

    cell_row_header_width = 40;
    cell_row_header_height = cell_height;

    selected_header_color = '#DDD';

    spreadsheet_area_x = canvas_width - cell_col_header_width;
    spreadsheet_area_y = canvas_height - cell_col_header_height;

    cell_display_x = Math.round(canvas_width / cell_width);
    cell_display_y = Math.round(canvas_height / cell_height);

    if(window.conv_array.length)
    {

      dx = -0.5;
      dy = -0.5;

      font_size=15;

      ctx.lineWidth='1';
      ctx.strokeStyle='#C0C0C0';
      ctx.fillStyle='#fff';
      ctx.shadowBlur=0;
      ctx.font=font_size+'px Arial';
      ctx.textAlign="center";
      ctx.textBaseline="middle";

      cell_row_font_offset_x=(cell_row_header_width / 2);
      cell_row_font_offset_y=(cell_row_header_height / 2);

      //cell_col_font_offset_x dynamically evaluated
      cell_col_font_offset_y=(cell_col_header_height / 2);

      selected=[];

      for(y=0;y<window.conv_array.length;y++)
      {
        for(x=0;x<window.conv_array[y].length;x++)
        {
          if(x==0)
          {
            dx=-0.5;
            dy=(y*25)-0.5;
          }
          //cell value
          cell_col_font_offset_x=(col_widths[x] / 2);

          if(window.canvas_clicked)
          {
            if(window.canvas_mouse_x > dx && window.canvas_mouse_x <= (parseInt(dx) + parseInt(col_widths[x])))
            {
              if(window.canvas_mouse_y > dy && window.canvas_mouse_y <= (parseInt(dy) + parseInt(cell_col_header_height)))
              {
                console.log(dx,dy,'has been clicked!');
                selected=[dx,dy,col_widths[x],cell_col_header_height];
              }
            }
          }

          ctx.beginPath();

          ctx.fillStyle='#fff';

          ctx.fillRect(dx,dy,col_widths[x],cell_col_header_height);

          ctx.strokeStyle='#C0C0C0';

          ctx.rect(dx,dy,col_widths[x],cell_col_header_height);

          ctx.stroke();

          ctx.closePath();

          if(conv_array[y][x])
          {
            ctx.fillStyle='#000';
            ctx.fillText(decode(conv_array[y][x]),dx+cell_col_font_offset_x,dy+cell_col_font_offset_y);
            ctx.fillStyle='#fff';
          }

          dx+=parseInt(col_widths[x]);
        }
      }

      if(selected.length)
      {
        console.log('running code');

        ctx.beginPath();

        ctx.strokeStyle='#3498db';

        ctx.rect(selected[0],selected[1],selected[2],selected[3]);
        ctx.rect(selected[0]+1,selected[1]+1,selected[2]-2,selected[3]-2);

        ctx.stroke();

        ctx.closePath();
      }
    }
  }
}

function reset()
{
  canvas.attr('height','0px');
  canvas.attr('width','0px');
}

function decode(input)
{
  var txt = document.createElement("textarea");
  txt.innerHTML = input;
  return txt.value;
}

function explode(delimiter,string,limit=null)
{
  result=[];
  if(string.indexOf(delimiter)>-1)
  {
    bits=string.split(delimiter);
    if(bits.length>limit&&limit!==null)
    {
      temp='';
      for(z=0;z<limit;z++)
      {
        result[z]=bits[z];
      }
      for(z=limit;z<bits.length;z++)
      {
        temp+=bits[z];
      }
      result[limit]=temp;
      return result;
    }
    else
    {
      return bits;
    }
  }
  else
  {
      console.log('Supplied delimiter does not exist in string');
  }
}

function toLetters(num) {
    "use strict";
    var mod = num % 26,
        pow = num / 26 | 0,
        out = mod ? String.fromCharCode(64 + mod) : (--pow, 'Z');
    return pow ? toLetters(pow) + out : out;
}
