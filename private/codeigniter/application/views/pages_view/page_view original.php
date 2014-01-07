<!-- replaced by new Page View look (page_view.php) /-->
<div id="background">
    <div id="page_title_wrapper">
        <h1 id="page_title"> <?php echo $page_info->title; ?> </h1>	
        <p id="page_description" > <?php echo $page_info->description; ?> </p><br />
        <span style="font-size:10px;"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br /><br />Any contributions made to this website will be licensed under <br /><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons License Attribution 3.0</a><br />unless otherwise stated.</span>
        <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="iseaSwarm">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>
    </div>  
    
    <a id="main_home_button" href="<?php echo base_url(); ?>index.php/swarmtv/map/<?php echo $page_info->group; ?>">&nbsp;</a>
</div>
