<?php
      echo '<?xml version="1.0"?>',"\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
	<url>
			<loc><?php echo $this->Html->url('/',true); ?></loc>
			<changefreq>monthly</changefreq>
		    <priority>1</priority>
	  
	 </url>
	<?php foreach($categories as $v):?>
		 <url>
			<loc><?php echo $this->Html->url($v['Category']['link'],true); ?></loc>
			<changefreq>monthly</changefreq>
		    <priority>0.5</priority>
	    </url>
	<?php endforeach;?>
	<?php foreach($projects as $v):?>
		 <url>
			<loc><?php echo $this->Html->url($v['Project']['link'],true); ?></loc>
			<lastmod><?php echo $this->Time->format($v['Project']['modified'],'%Y-%m-%d') ?></lastmod>
			<changefreq>monthly</changefreq>
		    <priority>0.8</priority>
		    <?php if(isset ($v['Media']) ): ?>
				    <?php foreach ($v['Media'] as $img): ?>
										<?php if( isset($img['file']) and !empty($img['file'] )): ?>
												<image:image>
												     <image:loc><?php echo $this->Html->url($img['file'],true); ?></image:loc>
												 </image:image>
										<?php endif; ?>
					<?php endforeach; ?>
			<?php endif; ?>
	    </url>
	<?php endforeach;?>
	<url>
			<loc><?php echo $this->Html->url('/me-connaitre',true); ?></loc>
			<changefreq>yearly</changefreq>
		    <priority>1</priority>
	  
	 </url>
	 <url>
			<loc><?php echo $this->Html->url('/cv',true); ?></loc>
			<changefreq>yearly</changefreq>
		    <priority>1</priority>
	  
	 </url>
</urlset>