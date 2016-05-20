window.selected_key_array=[];
window.selected_val_array=[];

window.selected_array=[];
window.select_display=false;

window.

window.keystatus=[];
window.keystatus['K']=false;
window.keystatus['V']=false;

kd.run(function(){kd.tick();});
kd.K.down(function(){window.keystatus['K']=true;});
kd.K.up(function(){window.keystatus['K']=false;});

kd.V.down(function(){window.keystatus['V']=true;});
kd.V.up(function(){window.keystatus['V']=false;});

kd.ENTER.down(function()
{
  if(window.selected_key_array.length&&window.selected_val_array.length)
  {
    if(window.selected_key_array.length==window.selected_val_array.length)
    {
      for(z=0;z<window.selected_key_array.length;z++)
      {
        $("td#"+window.selected_key_array[z]).css('background-image','none');
        $("td#"+window.selected_key_array[z]).css('border-color','#eee');

        $("td#"+window.selected_val_array[z]).css('background-image','none');
        $("td#"+window.selected_val_array[z]).css('border-color','#eee');
      }
    }
    else
    {
      console.log('An error occured: key_num != val_num');
    }
  }
});

$(function()
{
  $("td.bind").on('click',function(e)
  {
    if(window.keystatus['K'])
    {
      $(this).css('background-image','url(http://localhost/img/selected.gif)');
      $(this).css('border-color','#85C4ED');

      add_to_key_array($(this).attr('id'));

      compile_select_display();
    }

    if(window.keystatus['V'])
    {
      $(this).css('background-image','url(http://localhost/img/selected.gif)');
      $(this).css('border-color','#2ecc71');

      add_to_val_array($(this).attr('id'));

      compile_select_display();
    }

    e.stopPropagation();
  });
});

function compile_select_display()
{
  if(!window.select_display)
  {
    window.select_display=true;

    $('<div/>',
    {
      id: 'selectdisplay',
    }).appendTo('body');
  }

  $("div#selectdisplay").empty();

  max=Math.max(selected_key_array.length,selected_val_array.length);

  push_string='';

  for(z=0;z<max;z++)
  {
    if(selected_key_array[z]!=null)
    {
      push_string+='<div id="SDH-'+selected_key_array[z]+'" class="selectdisplaykeyheader">KEY: '+$("td#"+selected_key_array[z]).text()+'</div>';
    }

    if(selected_val_array[z]!=null)
    {
      push_string+='<div id="SDH-'+selected_val_array[z]+'" class="selectdisplayvalheader">VAL: '+$("td#"+selected_val_array[z]).text()+'</div>';
    }
  }

  $("div#selectdisplay").append(push_string);
}

function add_to_key_array(id)
{
  result=true;

  for(z=0;z<window.selected_key_array.length;z++)
  {
    if(window.selected_key_array[z]==id)
    {
      result=false;
      console.log('Value already exists in array');
    }
  }

  if(result)
  {
      window.selected_key_array.push(id);
  }
}

function add_to_val_array(id)
{
  result=true;

  for(z=0;z<window.selected_val_array.length;z++)
  {
    if(window.selected_val_array[z]==id)
    {
      result=false;
      console.log('Value already exists in array');
    }
  }

  if(result)
  {
      window.selected_val_array.push(id);
  }
}
