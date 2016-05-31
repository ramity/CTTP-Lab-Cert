window.conv_array=[];

window.keystatus=[];
window.keytoggled=[];
window.keystatus['K']=false;
  window.keytoggled['K']=false;

window.keystatus['T']=false;
  window.keytoggled['T']=false;

window.keystatus['V']=false;
  window.keytoggled['V']=false;

window.keystatus['LMOUSE']=false;
  window.keytoggled['LMOUSE']=false;

window.keystatus['CTRL']=false;
  window.keytoggled['CTRL']=false;

window.selected=[];

window.toolbar_open=false;
//window.toolbar_w
window.toolbar_h=200;

window.canvas_clicked=false;

window.canvas_mouse_x=0;
window.canvas_mouse_y=0;

window.screen_mouse_x=0;
window.screen_mouse_y=0;

window.contextmenu_open=false;

window.scroll_x=0;
window.scroll_y=0;

//ALL VARAIBLE DEFININING KEYBOARD INPUT FUNCTIONS
$(document).mousedown(function(){window.keystatus['LMOUSE']=true;});
$(document).mouseup(function(){window.keystatus['LMOUSE']=false;});

kd.run(function(){kd.tick();});

kd.K.down(function(){window.keystatus['K']=true;});
kd.K.up(function(){window.keystatus['K']=false;});

kd.V.down(function(){window.keystatus['V']=true;});
kd.V.up(function(){window.keystatus['V']=false;});

kd.T.down(function(){window.keystatus['T']=true;});
kd.T.up(function(){window.keystatus['T']=false;});

kd.ENTER.down(function(){});

//ONLOAD FUNCTION
$(function()
{
  //ON MOUSEMOVE FUNCTIONS / VALUES
  $('canvas#container').on('mousemove',function(e)
  {
    on_mousemove_handler(this,e);
  });

  $(document).on('mousemove',function(e)
  {
    window.screen_mouse_x=e.clientX;
    window.screen_mouse_y=e.clientY;
  });

  //ON CLICK FUNCTIONS / VALUES
  $('canvas#container').click(function(e)
  {
    on_click_canvas_handler();
  });

  //ON SCROLL FUNCTIONS / VALUES
  $('div#spreadsheet_holder').scroll(function()
  {
    on_scroll_handler(this);
  });

  //ON RIGHTCLICK FUNCTIONS / VALUES
  $("canvas#container").on("contextmenu",function(e)
  {
    return open_contextmenu(e);
  });

  draw();
});

//CANVAS DRAW FUNTION
function draw()
{
  window.toolbar_w=document.body.clientWidth;

  $('div#spreadsheet_main').css('width',document.body.clientWidth);
  $('div#spreadsheet_main').css('height',$(window).height()-155);

  $('div#spreadsheet_holder').css('width',(document.body.clientWidth-40));

  if(window.toolbar_open)
  {
    $('div#spreadsheet_holder').css('height',($(window).height()-205-toolbar_h));
  }
  else
  {
    $('div#spreadsheet_holder').css('height',($(window).height()-205));
  }

  if(conv_array.length)
  {
    canvas = $('canvas#container');
    canvas_container = $('div#canvas_container');

    ctx = $("canvas#container").get(0).getContext('2d');

    reset();

    canvas.attr('width',window.canvas_width+'px');
    canvas.attr('height',window.canvas_height+'px');

    canvas.css('width',window.canvas_width);
    canvas.css('height',window.canvas_height);

    window.cell_height = 25;

    window.cell_col_header_height = cell_height;

    window.cell_row_header_width = 40;
    window.cell_row_header_height = cell_height;

    window.selected_header_color = '#DDD';

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

      window.selected=[];

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
                selected=[dx,dy,parseInt(col_widths[x][0]),cell_col_header_height,toLetters(x+1),(y+1)];
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
        ctx.beginPath();

        ctx.strokeStyle='#3498db';

        ctx.rect(selected[0],selected[1],selected[2],selected[3]);
        ctx.rect(selected[0]+1,selected[1]+1,selected[2]-2,selected[3]-2);

        ctx.stroke();

        ctx.closePath();

        t_col=selected[4];
        t_row=selected[5];

        $('div#col_holder').children().css('background-color','#f3f3f3');
        $('div#row_holder').children().css('background-color','#f3f3f3');

        $('div#col_header_'+selected[4]).css('background-color','#ddd');
        $('div#row_header_'+selected[5]).css('background-color','#ddd');
      }
    }
  }
}

//CANVAS RESET/CLEAR FUNCTION(S)
function reset()
{
  canvas.attr('height','0px');
  canvas.attr('width','0px');
}

//MISC FUNCTIONS
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

function toLetters(num)
{
  "use strict";
  var mod = num % 26,
    pow = num / 26 | 0,
    out = mod ? String.fromCharCode(64 + mod) : (--pow, 'Z');
  return pow ? toLetters(pow) + out : out;
}

//ON_[EVEN]_HANDLER FUNCTIONS
$(window).resize(function()
{
  draw();
});

function on_scroll_handler(elm)
{
  window.current_scroll_x=$(elm).scrollLeft();
  window.current_scroll_y=$(elm).scrollTop();

  if(window.scroll_x!=current_scroll_x)
  {
    window.scroll_x=current_scroll_x;
    $('div#col_holder').css('left',(-current_scroll_x + 40));
  }

  if(window.scroll_y!=current_scroll_y)
  {
    window.scroll_y=current_scroll_y;
    $('div#row_holder').css('top',(-current_scroll_y + 180));
  }
}

function on_mousemove_handler(elm,e)
{
  area=elm.getBoundingClientRect();

  window.canvas_mouse_x = e.clientX - area.left;
  window.canvas_mouse_y = e.clientY - area.top;

  $('div#menubar_mouse').text('x '+canvas_mouse_x+' : y '+canvas_mouse_y);
}

function on_click_canvas_handler()
{
  window.canvas_clicked=true;

  if(window.contextmenu_open)
  {
    $('div#contextmenu').remove();
  }

  draw();
}

window.toolbar_resizing_y_start=0;
window.toolbar_resizing_y_end=0;

window.toolbar_resizing=false;

window.toolbar_resizebar_clicked=false;

window.toolbar_array=[];

//OPEN_[OBJECT] FUNCTIONS
function open_toolbar()
{
  if(toolbar_open)
  {
    window.toolbar_open=false;
    $('div#toolbar')
  }
  else
  {
    window.toolbar_open=true;
  }

  close_contextmenu_handler();

  draw();

  toolbar=document.createElement('div');
  toolbar.id='toolbar';

  toolbar_resizebar=document.createElement('div');
  toolbar_resizebar.id='toolbar_resizebar';

  toolbar_holder=document.createElement('div');
  toolbar_holder.id=toolbar_holder;

  $('div#spreadsheet_main').append(toolbar);
  $('div#toolbar').append(toolbar_resizebar);

  //FUNCTIONS ATTACHED TO ALLOW FOR RESIZING OF TOOLBAR
  $('div#toolbar_resizebar').on('mousedown',function()
  {
    window.toolbar_resizebar_clicked=true;

    window.toolbar_resizing_y_start=window.screen_mouse_y;
  });

  $('div#toolbar_resizebar').on('mouseleave',function()
  {
    if(window.toolbar_resizebar_clicked)
    {
      window.toolbar_resizing=true;

      window.toolbar_resizebar_clicked=false;
    }
  });

  $(document).mouseup(function()
  {
    if(window.toolbar_resizing)
    {
      window.toolbar_resizing_y_end=window.screen_mouse_y;

      window.toolbar_h = window.toolbar_h + (toolbar_resizing_y_start - toolbar_resizing_y_end);

      $('div#toolbar').css('height',window.toolbar_h);

      window.toolbar_resizing=false;

      draw();
    }
  });

}

function open_contextmenu(e)
{
  window.canvas_clicked=true;

  offset = $(this).offset();

  if(contextmenu_open)
  {
    $('div#contextmenu').remove();
  }

  contextmenu=document.createElement('div');
  contextmenu.id='contextmenu';

  contextmenu.style.cssText='left:'+(canvas_mouse_x)+'px;top:'+(canvas_mouse_y)+'px';

  contextmenu_items=
  [
    //FORMAT:
    //active, text, id, onclick function//
    [1,'Copy','ctmi_copy',0],
    [0,'Add selection to keys','ctmi_add_sel_keys',0],
    [0,'Add selection to values','ctmi_add_sel_vals',0],
    [1,'Open toolbar','ctmi_open_toolbar','open_toolbar'],
    [1,'Open key overlay','ctmi_open_key_overlay',0],
    [1,'Open value overlay','ctmi_open_val_overlay',0]
  ];

  if(window.toolbar_open)
  {
    temp=[1,'Push to toolbar','ctmi_push_tools','push_to_tools'];
    contextmenu_items.push(temp);
  }

  $('div#spreadsheet_holder').append(contextmenu);

  for(z=0;z<contextmenu_items.length;z++)
  {
    if(contextmenu_items[z][0])
    {
      $('div#contextmenu').append('<div id="'+contextmenu_items[z][2]+'"class="contextmenu_item">'+contextmenu_items[z][1]+'</div>');

      //for safest practice - declaring function as defined rather than string->function conversion
      if(contextmenu_items[z][3]=='open_toolbar')
      {
        $('div#'+contextmenu_items[z][2]).on('click',function(){open_toolbar()});
      }
      if(contextmenu_items[z][3]=='push_to_tools')
      {
        $('div#'+contextmenu_items[z][2]).on('click',function(){push_to_tools()});
      }
    }
    else
    {
      $('div#contextmenu').append('<div class="contextmenu_item_disabled">'+contextmenu_items[z][1]+'</div>');
    }
  }

  window.contextmenu_open=true;

  draw();

  return false;
}

window.toolbar_array=[];
//PUSH_TO_[OBJECT] FUNCTIONS
function push_to_tools()
{
  console.log(window.selected);
  console.log(conv_array[selected[5]-1][fromLetters(selected[4])-1]);

  item_row = document.createElement('div');
  item_row.id = 'row_' + toolbar_array.length;
  item_row.className = 'toolbar_row';

  $('div#toolbar').append(item_row);

  item_label = document.createElement('input');
  item_label.id = 'toolbar_item_' + toolbar_array.length;
  item_label.type = 'text';
  item_label.className = 'toolbar_label';
  //item_label.value = conv_array[selected[5]-1][fromLetters(selected[4])-1];

  $('row_' + toolbar_array.length).append(item_label);

  //conv_array[x], conv_array[_][y], conv_array[x][y],
  toolbar_array.push([selected[5]-1,fromLetters(selected[4])-1,conv_array[selected[5]-1][fromLetters(selected[4])-1]]);

}

//CLOSE_[OBJECT]_HANDLER FUNCTIONS
function close_contextmenu_handler()
{
  if(window.contextmenu_open)
  {
    $('div#contextmenu').remove();
  }
}

function fromLetters(str)
{
  var out = 0,
      len = str.length,
      pos = len;

  while (--pos > -1)
  {
    out += (str.charCodeAt(pos) - 64) * Math.pow(26, len - 1 - pos);
  }

  return out;
}
