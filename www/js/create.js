form=[];

des_inf=
[
  [
    ['tag','div'],
    ['class','inputrowbigheader'],
    ['value','Designation Information'],
    ['required','0']
  ],
  [
    ['label','Equipment ID'],
    ['description','Denotes the equipment ID number'],
    ['tag','text'],
    ['input_placeholder','Equipment ID'],
    ['name','equipment_id'],
    ['sql','`equipment_id` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Manufacturer'],
    ['description','Manufacturer of the specified device'],
    ['tag','text'],
    ['input_placeholder','Manufacturer'],
    ['name','manufacturer'],
    ['sql','`manufacturer` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Model #'],
    ['description','Model # of the specified device'],
    ['tag','text'],
    ['input_placeholder','Model #'],
    ['name','model_number'],
    ['sql','`model_number` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Serial #'],
    ['description','Serial # of the specified device'],
    ['tag','text'],
    ['input_placeholder','Serial #'],
    ['name','serial_number'],
    ['sql','`serial_number` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','University ID'],
    ['description','UoA ID of the specified device (if it has one)'],
    ['tag','text'],
    ['input_placeholder','University ID'],
    ['name','uark_id'],
    ['sql','`uark_id` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Location'],
    ['description','Location of the specified device'],
    ['tag','text'],
    ['input_placeholder','Location'],
    ['name','location'],
    ['sql','`location` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Calibration Date'],
    ['description','Date at which this calibration was performed'],
    ['tag','text'],
    ['input_placeholder','Date'],
    ['name','calibration_date'],
    ['sql','`calibration_date` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['tag','text'],
    ['label','Performed by'],
    ['description','Whom this calibration was performed by'],
    ['input_placeholder','Performed by'],
    ['name','performed_by'],
    ['sql','`performed_by` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Next Calibration Due'],
    ['description','Date at which the next calibration is due'],
    ['tag','text'],
    ['input_placeholder','Next Calibration Due'],
    ['name','calibration_due'],
    ['sql','`calibration_due` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Last Calibration'],
    ['description','Date at which the last calibration was performed'],
    ['tag','text'],
    ['input_placeholder','Last Calibration'],
    ['required','1'],
    ['name','calibration_last'],
    ['sql','`calibration_last` text COLLATE utf8_bin NOT NULL'],
  ],
  [
    ['label','Calibration Item'],
    ['description','What the calibration of the specified device to check/validate.'],
    ['tag','text'],
    ['input_placeholder','Calibration Item'],
    ['name','calibration_item'],
    ['sql','`calibration_item` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['label','Calibration Procedure'],
    ['description','Brief description of how the calibration is performed.'],
    ['input_placeholder','Calibration Procedure'],
    ['tag','text'],
    ['name','calibration_procedure'],
    ['sql','`calibration_procedure` text COLLATE utf8_bin NOT NULL'],
    ['required',1]
  ],
  [
    ['label','Calibration Equipment'],
    ['description','List any equipment used in the calibration of the device.'],
    ['tag','text'],
    ['input_placeholder','Calibration Equipment'],
    ['name','calibration_equipment'],
    ['sql','`calibration_equipment` text COLLATE utf8_bin NOT NULL'],
    ['required','1']
  ],
  [
    ['tag','div'],
    ['class','inputrowbigheader'],
    ['value','Collected Data'],
    ['required','0']
  ]
];

$(document).on('click','div#create-new-item',function(){
  form.push([]);
  form[form.length-1].push([]);
  render();
});

$(document).on('click','div#output-php',function(){
  output();
});

$(document).on('click','div.create-new-subitem',function(){
  bits=explode('create-subitem-',$(this).attr('id'));
  form[bits[1]].push([]);
  render();
});

$(document).on('change','select.display-item-input',function(){
  bits=explode('select-name-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  x=bits[0];
  y=bits[1];
  z=bits[2];
  form[x][y][z]=$(this).val();
  render();
});

$(document).on('change','input.display-item-input',function(){
  bits=explode('value-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  x=bits[0];
  y=bits[1];
  z=bits[2];
  form[x][y][z]=$(this).val();
  render();
});

$(document).on('click','div.display-item-delete',function(){
  bits=explode('delete-',$(this).attr('id'));
  moarbits=explode('-',bits[1]);
  x=bits[0];
  y=bits[1];
  form[x].splice(y,1);
  render();
});

$(document).on('click','div.display-delete-group',function(){
  bits=explode('delete-group-',$(this).attr('id'));
  x=bits[1];
  form.splice(x,1);
  render();
});

$(document).on('click','div#hide-code',function(){
  $('div#output').empty();
  $('div#output').toggle();
});

$(document).on('click','div#add-designation',function(){
  form=des_inf;
  render();
});

function render()
{
  $('div#display').empty();
  for(z=0;z<form.length;z++)
  {
    $('div#display').append('<div class="display-item" id="elm-'+z+'">');
      for(x=0;x<form[z].length;x++)
      {
        $('div#elm-'+z).append('<div class="display-item-label">Name:</div>');
        $('div#elm-'+z).append('<select class="display-item-input" id="select-name-'+z+'-'+x+'-0">');
          $('select#select-name-'+z+'-'+x+'-0').append('<option disabled selected value>select an option</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="label">label</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="class">class</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="description">description</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="tag">tag</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="value">value</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="input_placeholder">input_placeholder</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="name">name</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="sql">sql</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="required">required</option>');
          $('select#select-name-'+z+'-'+x+'-0').append('<option value="xl">xl</option>');
          if(form[z][x][0] != null)
          {
            $('select#select-name-'+z+'-'+x+'-0').val(form[z][x][0]);
          }
        $('div#elm-'+z).append('</select');
        $('div#elm-'+z).append('<div class="display-item-label">Value:</div>');
        if(form[z][x][1] != null)
        {
          $('div#elm-'+z).append('<input class="display-item-input" id="value-'+z+'-'+x+'-1" value="'+form[z][x][1]+'">');
        }
        else
        {
          $('div#elm-'+z).append('<input class="display-item-input" id="value-'+z+'-'+x+'-1">');
        }
        $('div#elm-'+z).append('<div class="display-item-delete" id="delete-'+z+'-'+x+'">delete</div>');
      }
      $('div#elm-'+z).append('<div class="create-new-subitem" id="create-subitem-'+z+'">Create new subitem</div>');
      $('div#elm-'+z).append('<div class="display-delete-group" id="delete-group-'+z+'">Delete item</div>');
    $('div#display').append('</div>');
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

function output()
{
  $('div#output').empty();
  $('div#output').show();
  $('div#output').append('<div id="hide-code">Hide PHP code</div>');
  $('div#output').append('<div class="output-line">[</div>');
  for(z=0;z<form.length;z++)
  {
    $('div#output').append('<div class="output-line-st">[</div>');
    for(x=0;x<form[z].length;x++)
    {
      $('div#output').append('<div class="output-line-dt" id="line-'+z+'-'+x+'"></div>');
      if(x!=form[z].length-1)
        $('div#line-'+z+'-'+x).append("'"+form[z][x][0]+"'=>'"+form[z][x][1]+"',");
      else
        $('div#line-'+z+'-'+x).append("'"+form[z][x][0]+"'=>'"+form[z][x][1]+"'");
    }
    if(z!=form.length-1)
      $('div#output').append('<div class="output-line-st">],</div>');
    else {
      $('div#output').append('<div class="output-line-st">]</div>');
    }
  }
  $('div#output').append('<div class="output-line">]</div>');
}
