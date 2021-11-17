<div class="main-center">
    <?php //echo "<pre>"; print_r($preparation_list[0]->resource_link); die; ?>
    <h2>{{ isset($preparation_list[0]->resource_name)?$preparation_list[0]->resource_name:'' }}</h2>
    <div class="d-flex align-items-center">
        <div>
            <div class="d-flex align-items-center">
                <iframe width="420" height="315"
                src="{{ isset($preparation_list[0]->resource_link)?$preparation_list[0]->resource_link:'' }}">
                </iframe>
            </div>
        </div>

    </div>

</div>
