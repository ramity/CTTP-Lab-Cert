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

window.keystatus['STATUS']=false;
window.keytoggled['STATUS']=false;

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

kd.SHIFT.down(function(){window.keystatus['SHIFT']=true;});
kd.SHIFT.up(function(){window.keystatus['SHIFT']=false;});

window.selection_modes=
[
  0,  //standard selection
  1,  //selection to fill a specified element
  2   //selection to push to toolbar
];

window.onbeforeunload = function(event)
{
  if(keystatus['SHIFT'])
  {
    return;
  }
  else
  {
    if(toolbar_array.length)
    {
      return "If you reload this page, you will lose all unsaved data.";
    }
    else
    {
      return;
    }
  }
}

//ONLOAD FUNCTION
$(function()
{
  $('div#menubar_selection_mode').text('Selection mode : ' + window.selection_mode);

  $('div#menubar_selection_mode').on('click',function()
  {
    toggle_selection_mode();
  });

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

  $('div#toolbar_button').on('click',function()
  {
    toggle_toolbar();
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

        if(window.selection_mode==1)
        {
          if(window.selection_type=='xl')
          {
            $(window.selection_to).val('['+t_col+','+t_row+']');
          }
          else if (window.selection_type=='val')
          {
            $(window.selection_to).val(conv_array[selected[5]-1][fromLetters(selected[4])-1]);
          }
          toggle_selection_mode(0);
        }
        else if(window.selection_mode==2)
        {
          push_to_tools();
        }
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
function toggle_toolbar()
{
  if(window.toolbar_open)
  {
    window.toolbar_open=false;

    $('div#toolbar').css('display','none');

    close_contextmenu_handler();

    draw();
  }
  else
  {
    window.toolbar_open=true;

    close_contextmenu_handler();

    draw();

    if($('div#toolbar').length)
    {
      $('div#toolbar').css('display','block');
    }
    else
    {
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
  }
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
    [1,'Open toolbar','ctmi_open_toolbar','open_toolbar'],
  ];

  if(window.toolbar_open)
  {
    temp=[1,'Push to toolbar','ctmi_push_tools','push_to_tools'];
    contextmenu_items.push(temp);
    contextmenu_items[1][1] = 'Close toolbar';
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
        $('div#'+contextmenu_items[z][2]).on('click',function(){toggle_toolbar()});
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
window.selection_mode=0;
window.selection_to='';
//PUSH_TO_[OBJECT] FUNCTIONS
function push_to_tools()
{
  close_contextmenu_handler();

  item_row = document.createElement('div');
  item_row.id = 'row_' + toolbar_array.length;
  item_row.className = 'toolbar_row';

  $('div#toolbar').append(item_row);

  //label
  label = conv_array[selected[5]-1][fromLetters(selected[4])-1][0];
  label = label.replace(':','');
  //name
  name = label.toLowerCase();
  name = name.replace("#","number");
  name = name.replace(/[^a-z\d\s]+/gi,"");
  name = name.replace(/\s+/g,"_");

  /* SELECTS */

  /* LABEL */
  item_label = document.createElement('input');
  item_label.id = 'toolbar_label_' + toolbar_array.length;
  item_label.type = 'text';
  item_label.className = 'toolbar_input';
  item_label.name = 'toolbar_label_' + toolbar_array.length;
  item_label.value = label;
  item_label.title = 'Label';

  /* DESCRIPTION */
  item_descr = document.createElement('input');
  item_descr.id = 'toolbar_descr_' + toolbar_array.length;
  item_descr.type = 'text';
  item_descr.className = 'toolbar_input';
  item_descr.name = 'toolbar_descr_' + toolbar_array.length;
  item_descr.placeholder = 'Description';
  item_descr.title = 'Description';

  /* TAG */
  item_tag = document.createElement('select');
  item_tag.id = 'toolbar_tag_' + toolbar_array.length;
  item_tag.className = 'toolbar_select';
  item_tag.name = 'toolbar_tag_' + toolbar_array.length;
  item_tag.value = conv_array[selected[5]-1][fromLetters(selected[4])-1];
  item_tag.title = 'Tag';

  /* PLACEHOLDER */
  item_placeholder = document.createElement('input');
  item_placeholder.id = 'toolbar_placeholder_' + toolbar_array.length;
  item_placeholder.type = 'text';
  item_placeholder.className = 'toolbar_input';
  item_placeholder.name = 'toolbar_placeholder_' + toolbar_array.length;
  item_placeholder.placeholder = 'Placeholder';
  item_placeholder.title = 'Placeholder';

  /* NAME */
  item_name = document.createElement('input');
  item_name.id = 'toolbar_name_' + toolbar_array.length;
  item_name.type = 'text';
  item_name.className = 'toolbar_input';
  item_name.name = 'toolbar_name_' + toolbar_array.length;
  item_name.value = name;
  item_name.title = 'Name';

  /* SQL */
  item_sql = document.createElement('input');
  item_sql.id = 'toolbar_sql_' + toolbar_array.length;
  item_sql.type = 'text';
  item_sql.className = 'toolbar_input';
  item_sql.name = 'toolbar_sql_' + toolbar_array.length;
  item_sql.value = '`' + name + '` text COLLATE utf8_bin NOT NULL' ;
  item_sql.title = 'SQL';

  /* REQUIRED */
  item_req = document.createElement('input');
  item_req.id = 'toolbar_req_' + toolbar_array.length;
  item_req.type = 'text';
  item_req.className = 'toolbar_input';
  item_req.name = 'toolbar_req_' + toolbar_array.length;
  item_req.value = '1';
  item_req.title = 'Required';

  /* XL */
  item_xl = document.createElement('input');
  item_xl.id = 'toolbar_xl_' + toolbar_array.length;
  item_xl.type = 'text';
  item_xl.className = 'toolbar_input';
  item_xl.name = 'toolbar_xl_' + toolbar_array.length;
  item_xl.value = '[' + selected[4] + ',' + selected[5] + ']';
  item_xl.title = 'Excel';

  /* VALUE */
  item_value = document.createElement('input');
  item_value.id = 'toolbar_value_' + toolbar_array.length;
  item_value.type = 'text';
  item_value.className = 'toolbar_input';
  item_value.name = 'toolbar_value_' + toolbar_array.length;
  item_value.title = 'Value';

  /* REORDER */
  item_reorder = document.createElement('select');
  item_reorder.id = 'toolbar_reorder_' + toolbar_array.length;
  item_reorder.className = 'toolbar_select';

  inputs=
  [
    item_label,
    item_descr,
    item_tag,
    item_placeholder,
    item_name,
    item_sql,
    item_req,
    item_xl,
    item_value
  ]

  $(('div#row_' + toolbar_array.length)).append(inputs);

  $(('select#toolbar_tag_' + toolbar_array.length)).append('<option selected>Text</option>');

  $('input#toolbar_xl_' + toolbar_array.length).on('dblclick',function()
  {
    $(this).val('[select new value]');

    window.selection_to = 'input#' + $(this).attr('id');
    window.selection_type = 'xl';

    toggle_selection_mode(1);
  });

  $('input#toolbar_value_' + toolbar_array.length).on('dblclick',function()
  {
    $(this).val('[select new value]');

    window.selection_to = 'input#' + $(this).attr('id');
    window.selection_type = 'val';

    toggle_selection_mode(1);
  });

  //conv_array[x], conv_array[_][y], conv_array[x][y],
  toolbar_array.push([selected[5]-1,fromLetters(selected[4])-1,conv_array[selected[5]-1][fromLetters(selected[4])-1]]);

}

function toggle_selection_mode(int=-1)
{
  if(int==-1)
  {
  if(window.selection_mode !== window.selection_modes[window.selection_modes.length-1])
  {
    window.selection_mode++;
    $('div#menubar_selection_mode').css('color','#2ecc71');
  }
  else
  {
    window.selection_mode=0;
    $('div#menubar_selection_mode').css('color','#000');
  }
  }
  else
  {
    window.selection_mode=int;
    if(int==0)
    {
      $('div#menubar_selection_mode').css('color','#000');
    }
    else
    {
      $('div#menubar_selection_mode').css('color','#2ecc71');
    }
  }
  $('div#menubar_selection_mode').text('Selection mode : ' + window.selection_mode);
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
