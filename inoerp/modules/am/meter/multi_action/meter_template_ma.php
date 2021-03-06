<div id="subinventory_divId">
 <div class="row small-top-margin">
  <div id="subinventory_search">
   <?php
   if (empty($readonly)) {
    if (property_exists($$class, 'option_lists')) {
     $s->option_lists = $$class->option_lists;
    }
    $s->setProperty('_search_order_by', filter_input(INPUT_GET, 'search_order_by'));
    $s->setProperty('_search_asc_desc', filter_input(INPUT_GET, 'search_asc_desc'));
    $s->setProperty('_per_page', filter_input(INPUT_GET, 'per_page'));
    $s->setProperty('_searching_class', $class);
    $s->setProperty('_initial_search_array', $$class->initial_search);
    $search_form = $search->search_form($$class);
    if (!empty($pagination)) {
     $pagination_statement = $pagination->show_pagination($pagination, 'subinventory', $pageno, $query_string);
    }
   }
   ?>
  </div>
  <div id="form_top">
  </div>
  <div id="searchForm" ><div class='hideDiv_inputfa fa-minus-circle clickable'></div>
   <div class='hideDiv_input_element'><?php echo!(empty($search_form)) ? $search_form : ""; ?></div></div>
  <div id ="form_header">
   <form  method="post" id="subinventory"  name="subinventory">
    <div id ="form_line" class="form_line"><span class="heading">Sub Inventory Details </span>
     <div id="tabsLine">
      <?php echo subinventory::$tab_header ?>
      <div class="tabContainer">
       <div id="tabsLine-1" class="tabContent">
        <table class="form_table">
         <?php echo subinventory::$tabs_header1_tr ?>
         <tbody class="form_data_line_tbody">
          <?php
          $count = 0;
          if (!empty($search_result)) {
           foreach ($search_result as $subinventory) {
            ?>         
            <tr class="subinventory_line<?php echo $count ?>">
             <td>    
              <ul class="inline_action">
               <li class="add_row_img"><i class="fa fa-plus-circle"></i></li>
               <li class="remove_row_img"><i class="fa fa-minus-circle"></i></li>
               <li><input type="checkbox" name="line_id_cb" value="<?php echo htmlentities($subinventory->subinventory_id); ?>"></li>           
              </ul>
             </td>
             <td><?php $f->text_field_widsr('subinventory_id'); ?></td>
             <td><?php echo $f->select_field_from_object('org_id', org::find_all_inventory(), 'org_id', 'org', $$class->org_id, 'org_id', $readonly); ?></td>
             <td><?php echo $f->select_field_from_object('type', subinventory::subinventory_type(), 'option_line_code', 'option_line_code', $$class->type, 'type', $readonly); ?></td>
             <td><?php echo $f->text_field_wid('subinventory'); ?></td>
             <td><?php form::text_field_wid('description'); ?></td>
             <td><?php echo form::select_field_from_object('locator_control', subinventory::locator_control(), 'option_line_code', 'option_line_code', $$class->locator_control, 'locator_control', $readonly); ?>	              </td>
             <td><?php echo form::checkBox_field('allow_negative_balance_cb' . $count, $$class->allow_negative_balance_cb, 'allow_negative_balance_cb', $readonly); ?> </td>
             <td><?php form::text_field_wids('default_cost_group'); ?></td>
            </tr>
            <?php
            $count = $count + 1;
           }
          }
          ?>
         </tbody>
        </table>
       </div>
       <div id="tabsLine-2" class="scrollElement" class="tabContent">
        <table class="form_table">
         <?php echo subinventory::$tabs_header2_tr ?>
         <tbody class="form_data_line_tbody">
          <?php
          $count = 0;
          if (!empty($search_result)) {
           foreach ($search_result as $subinventory) {
            ?>         
            <tr class="subinventory_line<?php echo $count ?>">
             <td><?php $f->ac_field_wid('material_ac_id') ?></td>
             <td><?php $f->ac_field_wid('material_oh_ac_id') ?></td>
             <td><?php $f->ac_field_wid('overhead_ac_id') ?></td>
             <td><?php $f->ac_field_wid('resource_ac_id') ?></td>
             <td><?php $f->ac_field_wid('osp_ac_id') ?></td>
             <td><?php $f->ac_field_wid('expense_ac_id') ?></td>
            </tr>
            <?php
            $count = $count + 1;
           }
          }
          ?>
         </tbody>
         <!--                  Showing a blank form for new entry-->

        </table>
       </div>
       <div id="tabsLine-3" class="tabContent">
        <table class="form_table" >
         <?php echo subinventory::$tabs_header3_tr ?>
         <tbody class="form_data_line_tbody">
          <?php
          $count = 0;
          if (!empty($search_result)) {
           foreach ($search_result as $subinventory) {
            ?>         
            <tr class="subinventory_line<?php echo $count ?>">
             <td>
              <?php echo form::extra_field($$class->ef_id, '10', $readonly); ?>
             </td>
             <td>                      
              <?php echo form::status_field($$class->status, $readonly); ?>
             </td>
             <td>
              <?php echo form::checkBox_field('rev_enabled_cb' . $count, $$class->rev_enabled_cb, 'rev_enabled_cb', $readonly); ?>
             </td> 
             <td>
              <?php form::text_field_wid('rev_number'); ?>

             </td> 

            </tr>
            <?php
            $count = $count + 1;
           }
          }
          ?>
         </tbody>
         <!--                  Showing a blank form for new entry-->

        </table>
       </div>
      </div>
     </div>
    </div> 
   </form>
  </div>
 </div>
 <!--END OF FORM HEADER-->
 <div class="row small-top-margin">
  <div id="pagination" style="clear: both;">
   <?php echo!(empty($pagination_statement)) ? $pagination_statement : "";
   ?>
  </div>
 </div>

</div>
<script type=text/javascript>
 var classSave = new saveMainClass();
 classSave.json_url = 'form.php?class_name=subinventory';
 classSave.line_key_field = 'subinventory';
 classSave.single_line = false;
 classSave.savingOnlyHeader = false;
 classSave.lineClassName = 'subinventory';
 classSave.saveMain();

 //add new row in multi action template
 $("#content").on("click", ".add_row_img", function () {
  var addNewRow = new add_new_rowMain();
  addNewRow.trClass = 'subinventory_line';
  addNewRow.tbodyClass = 'form_data_line_tbody';
  addNewRow.noOfTabs = 3;
  addNewRow.removeDefault = true;
  addNewRow.add_new_row();
 });
</script>
