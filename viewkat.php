<?php 
if($this->uri->segment(3) === 'tambah'){
    
    echo form_open('admin/ctrkat/masuk');
    echo form_input($nmkat).'<br/>';
    echo form_textarea($deskat).'<br/>';
    echo form_submit('mysubmit', 'Submit Post!');
    echo form_close();
    
}
else if($this->uri->segment(3) === 'edit')
{
    echo form_open('admin/ctrkat/update');
    echo form_hidden($idkat); 
    foreach ($ambil->result() as $value) {     
        echo form_input($nmkat, $value->nmkat).'<br/>';
        echo form_input($slugkat, $value->slugkat).'<br/>';
        echo form_textarea($deskat, $value->deskat).'<br/>';
        echo form_submit('mysubmit', 'Simpan');
    }
    echo form_close();
    
}else{ ?>
        

        <table>
            <?php foreach ($ambil->result() as $key) { ?>
                <tr>
                    <td><?php echo anchor('admin/ctrkat/'.$key->slugkat, $key->nmkat); ?></td>
                    <td><?php echo $key->slugkat; ?></td>
                    <td><?php echo $key->deskat; ?></td>
                    <td><?php echo anchor('admin/ctrkat/detil/'.$key->idkat, 'Detil'); ?></td>
                    <td><?php echo anchor('admin/ctrkat/edit/'.$key->idkat, 'Edit'); ?></td>
                    <td><?php echo anchor('admin/ctrkat/hapus/'.$key->idkat, 'Hapus'); ?></td>
                </tr>
            <?php } ?>
        </table>
        
        <?php echo anchor('admin/ctrkat/tambah', 'Tambah'); 

}?>
        