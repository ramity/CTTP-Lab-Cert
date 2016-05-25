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

    canvas_container.css('width',canvas_width);
    canvas_container.css('height',canvas_height);

    if(col_widths.length)
    {

    }

    canvas.attr('width',canvas_width+'px');
    canvas.attr('height',canvas_height+'px');

    canvas.css('width',canvas_width);
    canvas.css('height',canvas_height);

    cell_width = 100;
    cell_height = 25;

    scroll_distance_x=25;
    scroll_distance_y=25;

    cell_col_header_width = cell_width;
    cell_col_header_height = cell_height;

    cell_row_header_width = 40;
    cell_row_header_height = cell_height;

    selected_header_color = '#DDD';

    spreadsheet_area_x = canvas_width - cell_col_header_width;
    spreadsheet_area_y = canvas_height - cell_col_header_height;

    cell_display_x = Math.round(canvas_width / cell_width);
    cell_display_y = Math.round(canvas_height / cell_height);

    if(window.max > cell_display_x)
    {
      created_cell_x = window.max;
    }
    else
    {
      created_cell_x = cell_display_x;
    }

    if(window.conv_array.length)
    {
      if(window.conv_array.length > cell_display_y)
      {
        created_cell_y = window.conv_array.length;
      }
      else
      {
        created_cell_y = cell_display_y;
      }

      dx = 0;
      dy = 0;

      font_size=15;

      ctx.lineWidth='1';
      ctx.strokeStyle='#C0C0C0';
      ctx.fillStyle='#fff';
      ctx.font=font_size+'px Arial';
      ctx.textAlign="center";
      ctx.textBaseline="middle";

      cell_row_font_offset_x=(cell_row_header_width / 2);
      cell_row_font_offset_y=(cell_row_header_height / 2);

      //cell_col_font_offset_x dynamically evaluated
      cell_col_font_offset_y=(cell_col_header_height / 2);

      for(y=0;y<created_cell_y;y++)
      {
        for(x=0;x<created_cell_x;x++)
        {
          if(y==0 && x==0)
          {
            //spacer
            ctx.fillStyle='#F3F3F3';

            ctx.fillRect(dx,dy,cell_row_header_width,cell_row_header_height);
            ctx.rect(dx,dy,cell_row_header_width,cell_row_header_height);

            ctx.fillStyle='#fff';

            ctx.stroke();

            dx+=cell_row_header_width;
          }
          else if(y==0 && x!=0)
          {
            //col header
            cell_col_font_offset_x=(col_widths[x-1] / 2);

            ctx.fillStyle='#F3F3F3';

            ctx.fillRect(dx,dy,col_widths[x-1],cell_col_header_height);
            ctx.rect(dx,dy,col_widths[x-1],cell_col_header_height);

            ctx.fillStyle='#fff';

            ctx.stroke();

            ctx.fillStyle='#000';
            ctx.fillText(toLetters(x),dx+cell_col_font_offset_x,dy+cell_col_font_offset_y);
            ctx.fillStyle='#fff';

            dx+=parseInt(col_widths[x-1]);
          }
          else if(y!=0 && x==0)
          {
            //row header
            dx=0;
            dy+=cell_col_header_height;

            ctx.fillStyle='#F3F3F3';

            ctx.fillRect(dx,dy,cell_row_header_width,cell_row_header_height);
            ctx.rect(dx,dy,cell_row_header_width,cell_row_header_height);

            ctx.fillStyle='#fff';

            ctx.stroke();

            ctx.fillStyle='#000';
            ctx.fillText(y,dx+cell_row_font_offset_x,dy+cell_row_font_offset_y);
            ctx.fillStyle='#fff';

            dx+=cell_row_header_width;
          }
          else
          {
            //cell value
            cell_col_font_offset_x=(col_widths[x-1] / 2);

            ctx.fillStyle='#fff';

            ctx.fillRect(dx,dy,col_widths[x-1],cell_col_header_height);
            ctx.rect(dx,dy,col_widths[x-1],cell_col_header_height);

            ctx.stroke();

            if(conv_array[y][x])
            {
              ctx.fillStyle='#000';
              ctx.fillText(decode(conv_array[y-1][x-1]),dx+cell_col_font_offset_x,dy+cell_col_font_offset_y);
              ctx.fillStyle='#fff';
            }

            dx+=parseInt(col_widths[x-1]);
          }
        }
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
