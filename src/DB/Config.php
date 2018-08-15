<?php
namespace NetApp\DB;

class Config
{
    const PATH_TO_DB_FILE = 'db/netapp.db';
    const DB_BLUEPRINT = array(
        "hosts" => array(
            "columns" => array (
                "id"        => "INTEGER PRIMARY KEY",
                "hostname"  => "TEXT NOT NULL"
            )
        ),
        "interfaces" => array(
            "columns" => array(
                "id"        => "INTEGER PRIMARY KEY",
                "ip"        => "INTEGER",
                "mask"      => "INTEGER",
                "gateway"   => "INTEGER",
                "host_id"   => "INTEGER"
            ),
            "foreign_keys" => array(
                "host_id" => "hosts(id)"
            )
        )
    );
}
