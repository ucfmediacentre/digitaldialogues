<!-- replaces old Page View look (page_view original.php) /-->
<div id="background">
    <div id="page_title_wrapper">
        <h1 id="page_title"> <?php echo $page_info->group . " : " . $page_info->title; ?> </h1>	
        <p id="page_description" > <?php echo $page_info->description; ?> </p>
    </div>
    <div id="main_pages_wrapper">
        <a href="../../../pages/view/<?php echo $page_info->group; ?>/Home">Home</a>&nbsp;|&nbsp;<a href="../../../recentChanges?group=<?php echo $page_info->group; ?>">Recent Changes</a>&nbsp;|&nbsp;<a href="../../../pages/view/<?php echo $page_info->group; ?>/Shortcodes">Shortcodes</a>&nbsp;|&nbsp;<a href="../../../pages/view/<?php echo $page_info->group; ?>/Help">Help</a>
	<form action="<?php echo base_url(); ?>index.php/swarmtv/map/<?php echo $page_info->group; ?>" method="get" enctype="multipart/form-data" id="filter_form">
            <br />
            <input name="filter" value="" onchange="submit();" />
            <input type="submit" value="Search">
        </form>
    </div>
    <div id="editButtons">
        <p>Add: <a href="">Text</a>&nbsp;|&nbsp;<a href="">Image</a>&nbsp;|&nbsp;<a href="">Audio</a>&nbsp;|&nbsp;<a href="">Video</a>&nbsp;|&nbsp;<a href="">Page</a>&nbsp;|&nbsp;<a href="">Group</a></p>
    </div>
</div>
