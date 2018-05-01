


    <infinity  baseurl="commercial/items" inline-template>
        <div>

            <div v-if="$parent.$parent.showList">

                @include('back_office/items/list')
            </div>
            <div v-else>
            
                @include('back_office/items/form')
            </div>
        </div>
    </infinity>
