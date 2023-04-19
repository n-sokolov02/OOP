<?php
const DATA_SOURCE = 'data.json';

function write_data ($data) {
    return file_put_contents(DATA_SOURCE, json_encode($data));
}

function read_data () {
    return json_decode(file_get_contents(DATA_SOURCE), true);
}
