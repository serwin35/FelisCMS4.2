{extends file="assets/helpview/_Layout.tpl"}

{block name="head"}
	<title>Urloping - Hotele</title>
{/block}

{block name="content"}

        	<div class="panel panel-default panel-green margin-top-20">
              <div class="panel-heading"><i class="fa fa-building-o"></i> Hotele</div>
              <div class="panel-body">
                <!-- items -->
                <div class="row">
                {foreach from=$hotele item=item name=hotele}
                    <!-- item -->
                    <div class="col-md-4 margin-bottom-5 boxShadow">
			            <div class="panel panel-default panel-green hotele" style="height:180px;">
			              <div class="panel-body padding-10">
				              <div class="row">
                              	<div class="col-md-6">
                              		{html_image file="{$uploads}images/hotels/thumb_70/{$item.hp_photo}.{$item.hp_ext}" class="img-thumbnail margin-top-10" width="100%" height="100%" alt="{$item.hp_alt}" title="{$item.hp_title}"}
	                    		</div>
                              	<div class="col-md-6">
	                        		<h3 class="no-top-space no-bottom-space"><a href="{$base_url}hotele/hotel/{$item.id}">{$item.name}</a></h3>

                                    <div class="margin-top-10 margin-bottom-10">
                                    	{if $item.stars == 5}
                                    		<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    	{elseif $item.stars == 4}
                                    		<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    	{elseif $item.stars == 3}
                                    		<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    	{elseif $item.stars == 2}
                                    		<i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    	{else}
                                    		<i class="fa fa-star"></i>
                                    	{/if}
                                    </div>

		                            {$item.description|truncate:55:"...":true}

		                            <div class="margin-top-10 margin-bottom-10 text-right">
                                    	<a href="{$base_url}hotele/hotel/{$item.id}" class="btn btn-success btn-sm">więcej...</a>
		                            </div>
                              	</div>
				              </div>
			              </div>
			            </div>
                    </div>
                    <!-- item -->
                {/foreach}
                </div>
                <!-- items -->
              </div>
            </div>

{/block}