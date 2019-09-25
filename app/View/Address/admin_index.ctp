
<div class="row" >
	<div class="col-md-12 ">
		<a class='btn btn-success float-right' href="/admin/address/add"> Thêm mới dữ liệu </a>
	</div>

    <div class="col-md-12 ">
    <br/>
        <table class='table table-bordered ' >
            <tr>

                <th><?php echo $this->Paginator->sort('id', '#');?></th>
                <th><?php echo $this->Paginator->sort('province_id', 'Tỉnh/Thành phố');?></th>
                <th><?php echo $this->Paginator->sort('name', '');?></th>
                <th><?php echo $this->Paginator->sort('phone1', '');?></th>
                <th><?php echo $this->Paginator->sort('phone2', '');?></th>
                <th><?php echo $this->Paginator->sort('#', '');?></th>
                <th>Cập nhật</th>
            </tr>
        <?php foreach ($addressData as $key => $address)
        {?>
            <tr rel='data'>
                <td>
                    <a href='/admin/address/edit/<?php echo $address['Address']['id']; ?>'>
                        <?php echo $address['Address']['id']; ?>
                    </a>
                </td>
                <td><?php echo get_provinces($address['Address']['province_id']); ?></td>
                <td><?php echo $address['Address']['name']; ?></td>
                <td><?php echo $address['Address']['address']; ?></td>

                <td><?php echo $address['Address']['phone1']; ?></td>
                <td><?php echo $address['Address']['phone2']; ?></td>
                <td >
                    <a href="/admin/writing/delete/<?php echo $address['Address']['id']; ?>"  onclick="return confirm('Liên hệ này sẽ bị xóa..?')">
                        Xóa
                    </a>
                </td>

            </tr>
        <?php
        }?>
        </table>

        <?php if((int)$this->Paginator->counter('{:pages}')>1){ ?>
        <div class='pagination pull-right'>
            <ul class='pagination pagination-sm'>
            <?php
                echo $this->Paginator->first('<<',array('tag' => 'li'));
                echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->last('>>',array('tag' => 'li'));
            ?>
            </ul>
            <p><small class='pull-right'>
                <?php echo $this->Paginator->counter('Trang số {:page} trong {:pages} trang, hiển thị {:current} dòng trong tổng số {:count} dòng '); ?></small>
            </p>
        </div>
        <?php }?>
    </div>
</div>

