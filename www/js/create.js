var des_inf=
[
  {
    'tag':'div',
    'class':'inputrowbigheader',
    'value':'Designation Information',
    'required':0
  },
  {
    'label':'Equipment ID',
    'description':'Denotes the equipment ID number',
    'tag':'text',
    'input_placeholder':'Equipment ID',
    'name':'equipment_id',
    'sql':'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Manufacturer',
    'description':'Manufacturer of the specified device',
    'tag':'text',
    'input_placeholder':'Manufacturer',
    'name':'manufacturer',
    'sql':'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Model #',
    'description':'Model # of the specified device',
    'tag':'text',
    'input_placeholder':'Model #',
    'name':'model_number',
    'sql':'`model_number` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Serial #',
    'description':'Serial # of the specified device',
    'tag':'text',
    'input_placeholder':'Serial #',
    'name':'serial_number',
    'sql':'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'University ID',
    'description':'UoA ID of the specified device (if it has one)',
    'tag':'text',
    'input_placeholder':'University ID',
    'name':'uark_id',
    'sql':'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Location',
    'description':'Location of the specified device',
    'tag':'text',
    'input_placeholder':'Location',
    'name':'location',
    'sql':'`location` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Calibration Date',
    'description':'Date at which this calibration was performed',
    'tag':'text',
    'input_placeholder':'Date',
    'name':'calibration_date',
    'sql':'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Performed by',
    'description':'Whom this calibration was performed by',
    'tag':'text',
    'input_placeholder':'Performed by',
    'name':'performed_by',
    'sql':'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Next Calibration Due',
    'description':'Date at which the next calibration is due',
    'tag':'text',
    'input_placeholder':'Next Calibration Due',
    'name':'calibration_due',
    'sql':'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Last Calibration',
    'description':'Date at which the last calibration was performed',
    'tag':'text',
    'input_placeholder':'Last Calibration',
    'name':'calibration_last',
    'sql':'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Calibration Item',
    'description':'What the calibration of the specified device to check/validate.',
    'tag':'text',
    'input_placeholder':'Calibration Item',
    'name':'calibration_item',
    'sql':'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Calibration Procedure',
    'description':'Brief description of how the calibration is performed.',
    'tag':'text',
    'input_placeholder':'Calibration Procedure',
    'name':'calibration_procedure',
    'sql':'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'label':'Calibration Equipment',
    'description':'List any equipment used in the calibration of the device.',
    'tag':'text',
    'input_placeholder':'Calibration Equipment',
    'name':'calibration_equipment',
    'sql':'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required':1
  },
  {
    'tag':'div',
    'class':'inputrowbigheader',
    'value':'Collected Data',
    'required':0
  },
];

var parts_obj=[];

$(document).on('click','div#add_item',function()
{
  parts_obj[0].push([]);
  render(parts_obj[0]);
});

$(document).on('click','div#add_des_inf',function()
{
  parts_obj.push(des_inf);
  render(parts_obj[0]);
});

$(document).on('click','td.remove_button',function(){
  bits=explode('remove-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  z=moarbits[0];
  y=moarbits[1];
  delete parts_obj[0][z][Object.keys(parts_obj[0][z])[y]];
  render(parts_obj[0]);
});

$(document).on('click','td.edit_button',function(){
  bits=explode('edit-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  z=moarbits[0];
  y=moarbits[1];
  parts_obj[0][z][Object.keys(parts_obj[0][z])[y]]='input';
  Object.keys(parts_obj[0][z])[y]='input';
  render(parts_obj[0]);
});

$(document).on('click','div.add-row',function(){
  bits=explode('edit-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  z=moarbits[0];
  y=moarbits[1];
});

$(document).on('keypress','input.edit-name',function(event){
  if(event.keyCode==13)
  {
    event.preventDefault();
    bits=explode('name-',$(this).attr('name'));
    moarbits=explode('-',bits[1]);
    z=moarbits[0];
    y=moarbits[1];
    name=Object.keys(parts_obj[0][z])[y];
    value=parts_obj[0][z][Object.keys(parts_obj[0][z])[y]];

    parts_obj[0][z][$(this).val()]='input';

    delete parts_obj[0][z][Object.keys(parts_obj[0][z])[y]];

    render(parts_obj[0]);
  }
});

$(document).on('keypress','input.edit-value',function(event){
  if(event.keyCode==13)
  {
    event.preventDefault();
    bits=explode('value-',$(this).attr('name'));
    moarbits=explode('-',bits[1]);
    z=moarbits[0];
    y=moarbits[1];
    parts_obj[0][z][Object.keys(parts_obj[0][z])[y]]=$(this).val();
    render(parts_obj[0]);
  }
});

function render(input)
{
  $('div#display').empty();
  $('div#display').append('<div class="displayheader">Display</div>');
  var script='';
  for(z=0;z<input.length;z++)
  {
    var temp='';
    for(y=0;y<Object.keys(input[z]).length;y++)
    {
      if(input[z][Object.keys(input[z])[y]]!=='input')
        temp+='<tr id="row-'+z+'-'+y+'"><td class="name" id="name-'+z+'-'+y+'">'+Object.keys(input[z])[y]+'</td><td class="value" id="value-'+z+'-'+y+'">'+ input[z][Object.keys(input[z])[y]] +'</td><td class="remove_button" id="remove-'+z+'-'+y+'">X</td><td class="edit_button" id="edit-'+z+'-'+y+'">Edit</td></tr>';
      else
        temp+='<tr id="row-'+z+'-'+y+'"><td class="name" id="name-'+z+'-'+y+'"><input type="text" name="name-'+z+'-'+y+'" class="edit-name"></td><td class="value" id="value-'+z+'-'+y+'"><input type="text" name="value-'+z+'-'+y+'" class="edit-value"></td><td class="remove_button" id="remove-'+z+'-'+y+'">X</td><td class="edit_button" id="edit-'+z+'-'+y+'">Edit</td></tr>';
    }
    $('div#display').append('<table><tbody>'+temp+'</tbody></table><div class="tablefunctionbarholder"><div id="add-row-'+z+'" class="add-row tablefunctionbar">Add new row</div><div id="remove-group-'+z+'" class="remove-group tablefunctionbar">Remove group</div></div>');
  }
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
