<?php if (!defined('THINK_PATH')) exit(); if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl class="cate-item">
		<dt class="cf2">
			<form action="<?php echo U('edit');?>" method="post">
				
				<div class="fold"><i></i></div>
				<div class="order"><input type="text" name="sort" class="text input-mini" value="<?php echo ($list["sort"]); ?>"></div>
				<div class="order"> 
				<?php switch($list['level']): case "1": ?>一级菜单<?php break;?>
					<?php case "2": ?>二级菜单<?php break;?>
					<?php default: ?>未知菜单<?php endswitch;?>
				</div>
				<div class="name">
					<span class="tab-sign"></span>
					<input type="hidden" name="id" value="<?php echo ($list["id"]); ?>">
					<input type="text" name="title" class="span3" value="<?php echo ($list["title"]); ?>">
					<?php if(($list['level']) == "1"): if(count($list['_']) < 5): ?><a class="add-sub-cate" title="添加子菜单" href="<?php echo U('add?pid='.$list['id']);?>">
						<i class="icon-add"></i>
					</a><?php endif; endif; ?>
					<span class="help-inline msg"></span>
				</div>
				<div class="order fc2">
					<a title="编辑" href="<?php echo U('edit?id='.$list['id'].'&pid='.$list['pid']);?>">编辑</a>
					
					<a title="删除" href="<?php echo U('remove?id='.$list['id']);?>" class="confirm ajax-get">删除</a>
				</div>
			</form>
		</dt>
		<?php if(!empty($list['_'])): ?><dd>
				<?php echo R('Wechatmenu/tree', array($list['_']));?>
			</dd><?php endif; ?>
	</dl><?php endforeach; endif; else: echo "" ;endif; ?>