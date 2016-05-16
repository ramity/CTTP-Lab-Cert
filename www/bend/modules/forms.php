<?php
$form['1']=[
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Designation Information',
    'required'=>0
  ],
  [
    'label'=>'Equipment ID',
    'description'=>'Denotes the equipment ID number',
    'tag'=>'text',
    'input_placeholder'=>'Equipment ID',
    'name'=>'equipment_id',
    'sql'=>'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D5'
  ],
  [
    'label'=>'Manufacturer',
    'description'=>'Manufacturer of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Manufacturer',
    'name'=>'manufacturer',
    'sql'=>'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D6'
  ],
  [
    'label'=>'Model #',
    'description'=>'Model # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Model #',
    'name'=>'model_number',
    'sql'=>'`model_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D7'
  ],
  [
    'label'=>'Serial #',
    'description'=>'Serial # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Serial #',
    'name'=>'serial_number',
    'sql'=>'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D8'
  ],
  [
    'label'=>'University ID',
    'description'=>'UoA ID of the specified device (if it has one)',
    'tag'=>'text',
    'input_placeholder'=>'University ID',
    'name'=>'uark_id',
    'sql'=>'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D9'
  ],
  [
    'label'=>'Location',
    'description'=>'Location of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Location',
    'name'=>'location',
    'sql'=>'`location` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D10'
  ],
  [
    'label'=>'Calibration Date',
    'description'=>'Date at which this calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Date',
    'name'=>'calibration_date',
    'sql'=>'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J5'
  ],
  [
    'label'=>'Performed by',
    'description'=>'Whom this calibration was performed by',
    'tag'=>'text',
    'input_placeholder'=>'Performed by',
    'name'=>'performed_by',
    'sql'=>'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J6'
  ],
  [
    'label'=>'Next Calibration Due',
    'description'=>'Date at which the next calibration is due',
    'tag'=>'text',
    'input_placeholder'=>'Next Calibration Due',
    'name'=>'calibration_due',
    'sql'=>'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J8'
  ],
  [
    'label'=>'Last Calibration',
    'description'=>'Date at which the last calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Last Calibration',
    'name'=>'calibration_last',
    'sql'=>'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J9'
  ],
  [
    'label'=>'Calibration Item',
    'description'=>'What the calibration of the specified device to check/validate.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Item',
    'name'=>'calibration_item',
    'sql'=>'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C12'
  ],
  [
    'label'=>'Calibration Procedure',
    'description'=>'Brief description of how the calibration is performed.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Procedure',
    'name'=>'calibration_procedure',
    'sql'=>'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C14'
  ],
  [
    'label'=>'Calibration Equipment',
    'description'=>'List any equipment used in the calibration of the device.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Equipment',
    'name'=>'calibration_equipment',
    'sql'=>'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C16'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Collected Data',
    'required'=>0
  ],
  [
    'label'=>'Original Mass of Sample',
    'description'=>'Measured mass of sample to be hand sieved.',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample in grams',
    'name'=>'data_a',
    'sql'=>'`data_a` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D19'
  ],
  [
    'label'=>'3/4" Mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_b',
    'sql'=>'`data_b` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D23'
  ],
  [
    'label'=>'1/2" mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_c',
    'sql'=>'`data_c` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D24'
  ],
  [
    'label'=>'#4 mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_d',
    'sql'=>'`data_d` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D25'
  ],
  [
    'label'=>'#8 mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_e',
    'sql'=>'`data_e` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D26'
  ],
  [
    'label'=>'#16 mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_f',
    'sql'=>'`data_f` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D27'
  ],
  [
    'label'=>'#50 mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_g',
    'sql'=>'`data_g` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D28'
  ],
  [
    'label'=>'#100 mass passing',
    'description'=>'Measured mass of sample remaining',
    'tag'=>'text',
    'input_placeholder'=>'Mass of the sample remaining',
    'name'=>'data_h',
    'sql'=>'`data_h` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D29'
  ],
  [
    'label'=>'Specified tolerance',
    'description'=>'0.5% is the default required to pass calibration',
    'tag'=>'text',
    'input_placeholder'=>'% required to pass (tollerance)',
    'value'=>'0.5%',
    'name'=>'tolerance',
    'sql'=>'`tolerance` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C32'
  ],
  [
    'label'=>'(optional) Comments',
    'description'=>'Any comments or observations about the calibration.',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'data_comment',
    'sql'=>'`data_comment` text COLLATE utf8_bin',
    'required'=>0,
    'xl'=>'C38'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'data_initial',
    'sql'=>'`data_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'L42'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Maintenance',
    'required'=>0
  ],
  [
    'label'=>'Check #1',
    'description'=>'Check for cleanliness?',
    'tag'=>'select',
    'options'=>[
      [
        'value'=>'',
        'display_value'=>'Select True/False'
      ],
      [
        'value'=>1,
        'display_value'=>'True'
      ],
      [
        'value'=>0,
        'display_value'=>'False'
      ]
    ],
    'name'=>'maintenance_check_a',
    'sql'=>'`maintenance_check_a` int(1) NOT NULL',
    'required'=>1,
    'xl'=>'A45'
  ],
  [
    'label'=>'Check #2',
    'description'=>'Paddles do not show excessive wear?',
    'tag'=>'select',
    'options'=>[
      [
        'value'=>'',
        'display_value'=>'Select True/False'
      ],
      [
        'value'=>1,
        'display_value'=>'True'
      ],
      [
        'value'=>0,
        'display_value'=>'False'
      ]
    ],
    'name'=>'maintenance_check_b',
    'sql'=>'`maintenance_check_b` int(1) NOT NULL',
    'required'=>1,
    'xl'=>'A46'
  ],
  [
    'label'=>'Check #3',
    'description'=>'Greased if needed?',
    'tag'=>'select',
    'options'=>[
      [
        'value'=>'',
        'display_value'=>'Select True/False'
      ],
      [
        'value'=>1,
        'display_value'=>'True'
      ],
      [
        'value'=>0,
        'display_value'=>'False'
      ]
    ],
    'name'=>'maintenance_check_c',
    'sql'=>'`maintenance_check_c` int(1) NOT NULL',
    'required'=>1,
    'xl'=>'A47'
  ],
  [
    'label'=>'Maintenance Comments',
    'description'=>'Any comments or observations about the calibration.',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'maintenance_comment',
    'sql'=>'`maintenance_comment` text COLLATE utf8_bin',
    'required'=>0,
    'xl'=>'C48'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'maintenance_initial',
    'sql'=>'`maintenance_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'L51'
  ],
  [
    'label'=>'Pass/Fail',
    'name'=>'result',
    'sql'=>'`result` int(1) NOT NULL',
    'xl'=>'K35'
  ]
];
$form['2']=[
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Designation Information',
    'required'=>0
  ],
  [
    'label'=>'Equipment ID',
    'description'=>'Denotes the equipment ID number',
    'tag'=>'text',
    'input_placeholder'=>'Equipment ID',
    'name'=>'equipment_id',
    'sql'=>'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D5'
  ],
  [
    'label'=>'Manufacturer',
    'description'=>'Manufacturer of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Manufacturer',
    'name'=>'manufacturer',
    'sql'=>'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D6'
  ],
  [
    'label'=>'Model #',
    'description'=>'Model # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Model #',
    'name'=>'model_number',
    'sql'=>'`model_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D7'
  ],
  [
    'label'=>'Serial #',
    'description'=>'Serial # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Serial #',
    'name'=>'serial_number',
    'sql'=>'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D8'
  ],
  [
    'label'=>'University ID',
    'description'=>'UoA ID of the specified device (if it has one)',
    'tag'=>'text',
    'input_placeholder'=>'University ID',
    'name'=>'uark_id',
    'sql'=>'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D9'
  ],
  [
    'label'=>'Location',
    'description'=>'Location of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Location',
    'name'=>'location',
    'sql'=>'`location` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D10'
  ],
  [
    'label'=>'Calibration Date',
    'description'=>'Date at which this calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Date',
    'name'=>'calibration_date',
    'sql'=>'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J5'
  ],
  [
    'label'=>'Performed by',
    'description'=>'Whom this calibration was performed by',
    'tag'=>'text',
    'input_placeholder'=>'Performed by',
    'name'=>'performed_by',
    'sql'=>'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J6'
  ],
  [
    'label'=>'Next Calibration Due',
    'description'=>'Date at which the next calibration is due',
    'tag'=>'text',
    'input_placeholder'=>'Next Calibration Due',
    'name'=>'calibration_due',
    'sql'=>'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J8'
  ],
  [
    'label'=>'Last Calibration',
    'description'=>'Date at which the last calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Last Calibration',
    'name'=>'calibration_last',
    'sql'=>'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J9'
  ],
  [
    'label'=>'Calibration Item',
    'description'=>'What the calibration of the specified device to check/validate.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Item',
    'name'=>'calibration_item',
    'sql'=>'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C12'
  ],
  [
    'label'=>'Calibration Procedure',
    'description'=>'Brief description of how the calibration is performed.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Procedure',
    'name'=>'calibration_procedure',
    'sql'=>'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C14'
  ],
  [
    'label'=>'Calibration Equipment',
    'description'=>'List any equipment used in the calibration of the device.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Equipment',
    'name'=>'calibration_equipment',
    'sql'=>'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C16'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Collected Data',
    'required'=>0
  ],
  [
    'label'=>'Number of Chutes',
    'description'=>'Number of chutes in calibration.',
    'tag'=>'text',
    'input_placeholder'=>'Number of chutes (integer)',
    'name'=>'data_a',
    'sql'=>'`data_a` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D19'
  ],
  [
    'label'=>'Chute Opening #1',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_b',
    'sql'=>'`data_b` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D22'
  ],
  [
    'label'=>'Chute Opening #2',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_c',
    'sql'=>'`data_c` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D23'
  ],
  [
    'label'=>'Chute Opening #3',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_d',
    'sql'=>'`data_d` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D24'
  ],
  [
    'label'=>'Chute Opening #4',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_e',
    'sql'=>'`data_e` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D25'
  ],
  [
    'label'=>'Chute Opening #5',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_f',
    'sql'=>'`data_f` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D26'
  ],
  [
    'label'=>'Chute Opening #6',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_g',
    'sql'=>'`data_g` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D27'
  ],
  [
    'label'=>'Chute Opening #7',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_h',
    'sql'=>'`data_h` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D28'
  ],
  [
    'label'=>'Chute Opening #8',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_i',
    'sql'=>'`data_i` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D29'
  ],
  [
    'label'=>'Chute Opening #9',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_j',
    'sql'=>'`data_j` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D30'
  ],
  [
    'label'=>'Chute Opening #10',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_k',
    'sql'=>'`data_k` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D31'
  ],
  [
    'label'=>'Chute Opening #11',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_l',
    'sql'=>'`data_l` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D32'
  ],
  [
    'label'=>'Chute Opening #12',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_m',
    'sql'=>'`data_m` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D33'
  ],
  [
    'label'=>'Chute Opening #13',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_n',
    'sql'=>'`data_n` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D34'
  ],
  [
    'label'=>'Chute Opening #14',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_o',
    'sql'=>'`data_o` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D35'
  ],
  [
    'label'=>'Chute Opening #15',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_p',
    'sql'=>'`data_p` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D36'
  ],
  [
    'label'=>'Chute Opening #16',
    'description'=>'(length in mm)',
    'tag'=>'text',
    'input_placeholder'=>'Width of chute opening',
    'name'=>'data_q',
    'sql'=>'`data_q` text COLLATE utf8_bin NULL',
    'required'=>1,
    'xl'=>'D37'
  ],
  [
    'label'=>'Specified tolerance',
    'description'=>'##% larger than largest aggregate size. Ex) 50',
    'tag'=>'text',
    'input_placeholder'=>'% required to pass (tollerance)',
    'name'=>'tolerance',
    'sql'=>'`tolerance` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'H19+I20+H22+I23'
  ],
  [
    'label'=>'(optional) Comments',
    'description'=>'Any comments or observations about the calibration.',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'data_comment',
    'sql'=>'`data_comment` text COLLATE utf8_bin',
    'required'=>0,
    'xl'=>'C43'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'data_initial',
    'sql'=>'`data_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'L47'
  ],
  [
    'label'=>'Pass/Fail',
    'name'=>'result',
    'sql'=>'`result` int(1) NOT NULL',
    'xl'=>'K40'
  ]
];
$form['3']=[
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Designation Information',
    'required'=>0
  ],
  [
    'label'=>'Equipment ID',
    'description'=>'Denotes the equipment ID number',
    'tag'=>'text',
    'input_placeholder'=>'Equipment ID',
    'name'=>'equipment_id',
    'sql'=>'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D5'
  ],
  [
    'label'=>'Manufacturer',
    'description'=>'Manufacturer of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Manufacturer',
    'name'=>'manufacturer',
    'sql'=>'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D6'
  ],
  [
    'label'=>'Model #',
    'description'=>'Model # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Model #',
    'name'=>'model_number',
    'sql'=>'`model_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D7'
  ],
  [
    'label'=>'Serial #',
    'description'=>'Serial # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Serial #',
    'name'=>'serial_number',
    'sql'=>'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D8'
  ],
  [
    'label'=>'University ID',
    'description'=>'UoA ID of the specified device (if it has one)',
    'tag'=>'text',
    'input_placeholder'=>'University ID',
    'name'=>'uark_id',
    'sql'=>'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D9'
  ],
  [
    'label'=>'Location',
    'description'=>'Location of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Location',
    'name'=>'location',
    'sql'=>'`location` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D10'
  ],
  [
    'label'=>'Calibration Date',
    'description'=>'Date at which this calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Date',
    'name'=>'calibration_date',
    'sql'=>'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J5'
  ],
  [
    'label'=>'Performed by',
    'description'=>'Whom this calibration was performed by',
    'tag'=>'text',
    'input_placeholder'=>'Performed by',
    'name'=>'performed_by',
    'sql'=>'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J6'
  ],
  [
    'label'=>'Next Calibration Due',
    'description'=>'Date at which the next calibration is due',
    'tag'=>'text',
    'input_placeholder'=>'Next Calibration Due',
    'name'=>'calibration_due',
    'sql'=>'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J8'
  ],
  [
    'label'=>'Last Calibration',
    'description'=>'Date at which the last calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Last Calibration',
    'name'=>'calibration_last',
    'sql'=>'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'J9'
  ],
  [
    'label'=>'Calibration Item',
    'description'=>'What the calibration of the specified device to check/validate.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Item',
    'name'=>'calibration_item',
    'sql'=>'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C12'
  ],
  [
    'label'=>'Calibration Procedure',
    'description'=>'Brief description of how the calibration is performed.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Procedure',
    'name'=>'calibration_procedure',
    'sql'=>'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C14'
  ],
  [
    'label'=>'Calibration Equipment',
    'description'=>'List any equipment used in the calibration of the device.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Equipment',
    'name'=>'calibration_equipment',
    'sql'=>'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'C16'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Collected Data',
    'required'=>0
  ],
  [
    'label'=>'Top Inside Diameter of Cone #1',
    'description'=>'Tolerance = 40 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'top_diam_data_1',
    'sql'=>'`top_diam_data_1` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D19'
  ],
  [
    'label'=>'Top Inside Diameter of Cone #2',
    'description'=>'Tolerance = 40 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'top_diam_data_2',
    'sql'=>'`top_diam_data_2` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'F19'
  ],
  [
    'label'=>'Bottom Inside Diameter of Cone #1',
    'description'=>'Tolerance = 90 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'bot_diam_data_1',
    'sql'=>'`bot_diam_data_1` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D21'
  ],
  [
    'label'=>'Bottom Inside Diameter of Cone #2',
    'description'=>'Tolerance = 90 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'bot_diam_data_2',
    'sql'=>'`bot_diam_data_2` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'F21'
  ],
  [
    'label'=>'Height of Cone',
    'description'=>'Tolerance = 75 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'h_data',
    'sql'=>'`h_data` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D23'
  ],
  [
    'label'=>'Thickness of Cone #1',
    'description'=>'Tolerance = at least 0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_data_1',
    'sql'=>'`thickness_data_1` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D25'
  ],
  [
    'label'=>'Thickness of Cone #2',
    'description'=>'Tolerance = at least 0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_data_2',
    'sql'=>'`thickness_data_2` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'F25'
  ],
  [
    'label'=>'Thickness of Cone #3',
    'description'=>'Tolerance = at least 0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_data_3',
    'sql'=>'`thickness_data_3` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D26'
  ],
  [
    'label'=>'Thickness of Cone #4',
    'description'=>'Tolerance = at least 0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_data_4',
    'sql'=>'`thickness_data_4` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'F26'
  ],
  [
    'label'=>'Diameter of tamper face #1',
    'description'=>'Tolerance = 25 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'diam_tamper_data_1',
    'sql'=>'`diam_tamper_data_1` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D28'
  ],
  [
    'label'=>'Diameter of tamper face #2',
    'description'=>'Tolerance = 25 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'diam_tamper_data_2',
    'sql'=>'`diam_tamper_data_2` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'F28'
  ],
  [
    'label'=>'Mass of tamper',
    'description'=>'Tolerance = 340 +/- 15 g',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (g)',
    'name'=>'tamper_mass',
    'sql'=>'`tamper_mass` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'D30'
  ],
  [
    'label'=>'(optional) Comments',
    'description'=>'Any comments or observations about the calibration.',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'data_comment',
    'sql'=>'`data_comment` text COLLATE utf8_bin',
    'required'=>0,
    'xl'=>'C36'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'data_initial',
    'sql'=>'`data_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>1,
    'xl'=>'L40'
  ],
  [
    'label'=>'Pass/Fail',
    'name'=>'result',
    'sql'=>'`result` int(1) NOT NULL',
    'xl'=>'K32'
  ]
];
$form['4']=[
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Designation Information',
    'required'=>'0'
  ],
  [
    'label'=>'Equipment ID',
    'description'=>'Denotes the equipment ID number',
    'tag'=>'text',
    'input_placeholder'=>'Equipment ID',
    'name'=>'equipment_id',
    'sql'=>'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D5'
  ],
  [
    'label'=>'Manufacturer',
    'description'=>'Manufacturer of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Manufacturer',
    'name'=>'manufacturer',
    'sql'=>'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D6'
  ],
  [
    'label'=>'Model #',
    'description'=>'Model # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Model #',
    'name'=>'model_number',
    'sql'=>'`model_number` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D7'
  ],
  [
    'label'=>'Serial #',
    'description'=>'Serial # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Serial #',
    'name'=>'serial_number',
    'sql'=>'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D8'
  ],
  [
    'label'=>'University ID',
    'description'=>'UoA ID of the specified device (if it has one)',
    'tag'=>'text',
    'input_placeholder'=>'University ID',
    'name'=>'uark_id',
    'sql'=>'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D9'
  ],
  [
    'label'=>'Location',
    'description'=>'Location of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Location',
    'name'=>'location',
    'sql'=>'`location` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D10'
  ],
  [
    'label'=>'Calibration Date',
    'description'=>'Date at which this calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Date',
    'name'=>'calibration_date',
    'sql'=>'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J5'
  ],
  [
    'tag'=>'text',
    'label'=>'Performed by',
    'description'=>'Whom this calibration was performed by',
    'input_placeholder'=>'Performed by',
    'name'=>'performed_by',
    'sql'=>'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J6'
  ],
  [
    'label'=>'Next Calibration Due',
    'description'=>'Date at which the next calibration is due',
    'tag'=>'text',
    'input_placeholder'=>'Next Calibration Due',
    'name'=>'calibration_due',
    'sql'=>'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J8'
  ],
  [
    'label'=>'Last Calibration',
    'description'=>'Date at which the last calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Last Calibration',
    'required'=>'1',
    'name'=>'calibration_last',
    'sql'=>'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'xl'=>'J9'
  ],
  [
    'label'=>'Calibration Item',
    'description'=>'What the calibration of the specified device to check/validate.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Item',
    'name'=>'calibration_item',
    'sql'=>'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C12'
  ],
  [
    'label'=>'Calibration Procedure',
    'description'=>'Brief description of how the calibration is performed.',
    'input_placeholder'=>'Calibration Procedure',
    'tag'=>'text',
    'name'=>'calibration_procedure',
    'sql'=>'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C14'
  ],
  [
    'label'=>'Calibration Equipment',
    'description'=>'List any equipment used in the calibration of the device.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Equipment',
    'name'=>'calibration_equipment',
    'sql'=>'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C16'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Collected Data',
    'required'=>'0'
  ],
  [
    'label'=>'Top Inside Diameter of Cone #1',
    'description'=>'Tolerance = 40 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'top_diam_a',
    'sql'=>'`top_diam_a` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D19'
  ],
  [
    'label'=>'Top Inside Diameter of Cone #2',
    'description'=>'Tolerance = 40 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'top_diam_b',
    'sql'=>'`top_diam_b` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'F19'
  ],
  [
    'label'=>'Bottom Inside Diameter of Cone #1',
    'description'=>'Tolerance = 90 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'bot_diam_a',
    'sql'=>'`bot_diam_a` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D21'
  ],
  [
    'label'=>'Bottom Inside Diameter of Cone #1',
    'description'=>'Tolerance = 90 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'bot_diam_b',
    'sql'=>'`bot_diam_b` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'F21'
  ],
  [
    'label'=>'Height of Cone',
    'description'=>'Tolerance = 75 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'cone_height',
    'sql'=>'`cone_height` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D23'
  ],
  [
    'label'=>'Thickness of Cone #1',
    'description'=>'Tolerance = >0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_a',
    'sql'=>'`thickness_a` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D25'
  ],
  [
    'label'=>'Thickness of Cone #2',
    'description'=>'Tolerance = >0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_b',
    'sql'=>'`thickness_b` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'F25'
  ],
  [
    'label'=>'Thickness of Cone #3',
    'description'=>'Tolerance = >0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_c',
    'sql'=>'`thickness_c` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D26'
  ],
  [
    'label'=>'Thickness of Cone #3',
    'description'=>'Tolerance = >0.8 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'thickness_d',
    'sql'=>'`thickness_d` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'F26'
  ],
  [
    'label'=>'Diameter of tamper face #1',
    'description'=>'Tolerance = 25 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'dia_tamper_face_a',
    'sql'=>'`dia_tamper_face_a` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D28'
  ],
  [
    'label'=>'Diameter of tamper face #2',
    'description'=>'Tolerance = 25 +/- 3 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'dia_tamper_face_b',
    'sql'=>'`dia_tamper_face_b` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'F28'
  ],
  [
    'label'=>'Mass of tamper',
    'description'=>'Tolerance = 340 +/- 15 g',
    'tag'=>'text',
    'input_placeholder'=>'Measurement input (mm)',
    'name'=>'tamper_mass',
    'sql'=>'`tamper_mass` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D30'
  ],
  [
    'label'=>'(optional) Comments',
    'description'=>'Any comments or observations about the calibration',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'data_comment',
    'sql'=>'`data_comment` text COLLATE utf8_bin',
    'required'=>'0',
    'xl'=>'C36'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'data_initial',
    'sql'=>'`data_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'L40'
  ],
  [
    'label'=>'Pass/Fail',
    'name'=>'result',
    'sql'=>'`result` int(1) NOT NULL',
    'xl'=>'K38'
  ]
];
$form['4']=
[
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Designation Information',
    'required'=>'0'
  ],
  [
    'label'=>'Equipment ID',
    'description'=>'Denotes the equipment ID number',
    'tag'=>'text',
    'input_placeholder'=>'Equipment ID',
    'name'=>'equipment_id',
    'sql'=>'`equipment_id` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D5'
  ],
  [
    'label'=>'Manufacturer',
    'description'=>'Manufacturer of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Manufacturer',
    'name'=>'manufacturer',
    'sql'=>'`manufacturer` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D6'
  ],
  [
    'label'=>'Model #',
    'description'=>'Model # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Model #',
    'name'=>'model_number',
    'sql'=>'`model_number` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D7'
  ],
  [
    'label'=>'Serial #',
    'description'=>'Serial # of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Serial #',
    'name'=>'serial_number',
    'sql'=>'`serial_number` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D8'
  ],
  [
    'label'=>'University ID',
    'description'=>'UoA ID of the specified device (if it has one)',
    'tag'=>'text',
    'input_placeholder'=>'University ID',
    'name'=>'uark_id',
    'sql'=>'`uark_id` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D9'
  ],
  [
    'label'=>'Location',
    'description'=>'Location of the specified device',
    'tag'=>'text',
    'input_placeholder'=>'Location',
    'name'=>'location',
    'sql'=>'`location` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D10'
  ],
  [
    'label'=>'Calibration Date',
    'description'=>'Date at which this calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Date',
    'name'=>'calibration_date',
    'sql'=>'`calibration_date` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J5'
  ],
  [
    'tag'=>'text',
    'label'=>'Performed by',
    'description'=>'Whom this calibration was performed by',
    'input_placeholder'=>'Performed by',
    'name'=>'performed_by',
    'sql'=>'`performed_by` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J6'
  ],
  [
    'label'=>'Next Calibration Due',
    'description'=>'Date at which the next calibration is due',
    'tag'=>'text',
    'input_placeholder'=>'Next Calibration Due',
    'name'=>'calibration_due',
    'sql'=>'`calibration_due` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'J8'
  ],
  [
    'label'=>'Last Calibration',
    'description'=>'Date at which the last calibration was performed',
    'tag'=>'text',
    'input_placeholder'=>'Last Calibration',
    'required'=>'1',
    'name'=>'calibration_last',
    'sql'=>'`calibration_last` text COLLATE utf8_bin NOT NULL',
    'xl'=>'J9'
  ],
  [
    'label'=>'Calibration Item',
    'description'=>'What the calibration of the specified device to check/validate.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Item',
    'name'=>'calibration_item',
    'sql'=>'`calibration_item` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C12'
  ],
  [
    'label'=>'Calibration Procedure',
    'description'=>'Brief description of how the calibration is performed.',
    'input_placeholder'=>'Calibration Procedure',
    'tag'=>'text',
    'name'=>'calibration_procedure',
    'sql'=>'`calibration_procedure` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C14'
  ],
  [
    'label'=>'Calibration Equipment',
    'description'=>'List any equipment used in the calibration of the device.',
    'tag'=>'text',
    'input_placeholder'=>'Calibration Equipment',
    'name'=>'calibration_equipment',
    'sql'=>'`calibration_equipment` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'C16'
  ],
  [
    'tag'=>'div',
    'class'=>'inputrowbigheader',
    'value'=>'Collected Data',
    'required'=>'0'
  ],
  [
    'label'=>'Inside Diameter of Cylinder',
    'description'=>'Tolerance = approx. 39.02 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'ins_dia_cyl',
    'sql'=>'`ins_dia_cyl` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D19'
  ],
  [
    'label'=>'Inside Height of Cylinder',
    'description'=>'Tolerance = approx. 86 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'ins_hei_cyl',
    'sql'=>'`ins_hei_cyl` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D21'
  ],
  [
    'label'=>'Thickness of Cylinder Bottom',
    'description'=>'Tolerance = at least 6 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'thk_cyl_bot',
    'sql'=>'`thk_cyl_bot` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D23'
  ],
  [
    'label'=>'Inside Diameter of Funnel',
    'description'=>'Tolerance = 12.7 +/- 0.6 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'ins_dia_fun',
    'sql'=>'`ins_dia_fun` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D25'
  ],
  [
    'label'=>'Height of Funnel',
    'description'=>'Tolerance = at least 38 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'hei_fnl',
    'sql'=>'`hei_fnl` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D27'
  ],
  [
    'label'=>'Distance from Funnel to Cylinder',
    'description'=>'Tolerance = 155 +/- 2 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'dis_fun_cyl',
    'sql'=>'`dis_fun_cyl` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D29'
  ],
  [
    'label'=>'Width of Glass Plate',
    'description'=>'Tolerance = approx. 60 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'wid_gls_plt',
    'sql'=>'`wid_gls_plt` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D31'
  ],
  [
    'label'=>'Length of Glass Plate',
    'description'=>'Tolerance = approx. 60 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'lgt_gls_plt',
    'sql'=>'`lgt_gls_plt` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D33'
  ],
  [
    'label'=>'Thickness of Glass Plate',
    'description'=>'Tolerance = at least 4 mm',
    'tag'=>'text',
    'input_placeholder'=>'Measurement in mm',
    'name'=>'thk_gls_plt',
    'sql'=>'`thk_gls_plt` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'D35'
  ],
  [
    'label'=>'(optional) Comments',
    'description'=>'Any comments or observations about the calibration',
    'tag'=>'text',
    'input_placeholder'=>'Comments/Observations',
    'name'=>'data_comment',
    'sql'=>'`data_comment` text COLLATE utf8_bin',
    'required'=>'0',
    'xl'=>'C41'
  ],
  [
    'label'=>'Initial',
    'description'=>'Required to authorize calibration performed.',
    'tag'=>'text',
    'input_placeholder'=>'Initial by calibrator',
    'name'=>'data_initial',
    'sql'=>'`data_initial` text COLLATE utf8_bin NOT NULL',
    'required'=>'1',
    'xl'=>'L45'
  ],
  [
    'label'=>'Pass/Fail',
    'name'=>'result',
    'sql'=>'`result` int(1) NOT NULL',
    'xl'=>'K38'
  ]
]
?>
