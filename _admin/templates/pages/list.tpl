{include file="assets/helpview/head.tpl" titleTag="{lang line='pages_titleTag'}"}  

    <link rel="stylesheet" href="{$TEMPLATES}assets/js/libs/DataTables/jquery.dataTables-simple.css">
</head>
<body class="clearfix with-menu">
                                                                                                         
    <!-- Main content
    ================================================== -->
    <section role="main" id="main">
        <section id="mainContent">     
            {include file="assets/helpview/header.tpl"}        
        
            <!-- Body Header
            ================================================== -->
            <header>
                <h1 class="title"><i class="fa fa-2x fa-list"></i>  {lang line="pages_titleTag"}</h1>
                <ul class="breadcrumb unstyled-list">
                  <li><a href="#">{lang line="default_control_panel"}</a></li>   
                  <li class="active">{lang line="pages_titleTag"}</li>
                </ul>
            </header>  
                                 
            <div class="panel panel-default panel-black" id="panel">                                 
                <div class="panel-heading">{lang line="pages_titleTag"}
                    <div class="absolute-right">
                        <!-- toggle (show hide) -->
                        <a class="panel-toggle" data-toggle="collapse" data-parent="#panel" href="#panel-body"><b class="caret"></b></a>                                                                                                          
                    </div>
                </div>
                <!-- ./end panel-heading -->  
                <div id="panel-body" class="panel-body in">    
                    <table class="datatable table table-striped table-hover" id="table">
                      <thead>
                        <tr>
                            <th style="min-width:30px;">ID</th>
                            <th>{lang line="default_name"}</th>
                            <th>{lang line="default_adres"}</th>
                            <th>{lang line="default_category"}</th>
                            <th>{lang line="default_sidebar_access_lang"}</th>
                            <th style="width: 90px; text-align: center;">{lang line="default_action"}</th>
                        </tr>
                      </thead>
                      <tbody>
                        {foreach from=$pages item=item name=pages}
                            <!-- wpis -->
                                <tr>
                                    <td>{$item.id}</td>
                                    <td>{$item.name}</td>
                                    <td nowrap="nowrap"><a href="#" data-href="{$base_url}../{$item.alias}.html" class="preview with-tooltip" title="{lang line="default_sidebar_access_preview"}" data-title="{$item.name}">{$item.alias}.html</a></td>
                                    <td>{if $item.name_category}{$item.name_category}{else}{lang line="default_category_no"}{/if}</td>
                                    <td>{$item.lang}</td>
                                    <td class="actions">
                                        <a href="{$base_url}pages/edit/{$item.id}.html" title="{lang line="default_edit"}" class="felisEdit with-tooltip glyphicon glyphicon-pencil"></a>
                                    {if $item.active == 0}
                                        <a  id="status_{$item.id}" title="{lang line="default_active"}" data-item="{$item.id}" href="#" class="felisAccept glyphicon glyphicon-ok with-tooltip"></a>
                                    {else}
                                        <a id="status_{$item.id}" title="{lang line="default_block"}" data-item="{$item.id}" href="#" class="felisBlock glyphicon glyphicon-ban-circle with-tooltip"></a>
                                    {/if}
                                        <a href="#" data-item="{$item.id}" title="{lang line="default_delete"}" class="felisDel glyphicon glyphicon-trash with-tooltip confirm"></a>
                                    </td>
                                </tr>
                            <!-- koniec wpisu -->
                        {/foreach}
                      </tbody>
                    </table> 
                </div>
            </div>   
                        
            
          </section>                                                       
    </section>                                                       

   <!-- Sidebar
    ================================================== -->                                 
    {include file="assets/helpview/sidebar.tpl"}  
                                                                                          
{include file="assets/helpview/footer.tpl"} 
</body>
</html>