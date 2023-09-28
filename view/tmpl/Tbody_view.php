<?php
   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>



                        <?php if (!empty($table_body))
                               foreach ($table_body as $k => $v):
                                   ?> 
                                   <tr data-id ="<?= $v['id'] ?>" >
                                       <th><?= $v['id'] ?></th>
                                       <td><?= $v['name']; ?></td>
                                       <td><?= $v['phone']; ?></td>
                                       <td><?= $v['keyt']; ?></td>
                                       <td><?php echo date('d.m.Y H:i:s', strtotime($v['created_at'])); ?></td>
                                       <td><?php echo date('d.m.Y H:i:s', strtotime($v['updated_at'])); ?></td>
                                       <td>
                                           <span class="btn-group">
                                               <button type="button" onclick="functionChange(this)" class="btn btn-warning">Изм.</button>
                                               <button type="button" onclick="functionLog(this)" class="btn btn-info">Лог</button>
                                              
                                               
                                               <button type="button" onclick="functionDestroy(this)" class="btn btn-dark">Удалить</button>
                                           </span>
                                       </td>

                                   </tr>
       <?php endforeach; ?>

                 