<?php

class Bookings
{

    protected static $table_name = "bookings";
    protected static $db_fields = array('id', 'room_id', 'room_title', 'check_in', 'check_out', 'name', 'phone', 'email', 'message', 'book', 'created_at');

    public $id, $room_id, $room_title, $check_in, $check_out, $name, $phone, $email, $message, $book, $created_at;

    public static function find_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " ORDER BY id DESC");
    }

    public static function check_available($check_in, $check_out)
    {
        global $db;
        $sql = "SELECT DISTINCT room_id FROM bookings WHERE room_id NOT IN 
        (SELECT DISTINCT room_id FROM bookings WHERE 
            (check_in <= '$check_in' AND check_out >='$check_out') OR 
            (check_in >= '$check_in' AND check_in <='$check_out') OR 
            (check_in <= '$check_in' AND check_out >='$check_in') 
        )";

        $check = $db->query($sql)  or die(mysqli_connect_errno() . "Query Doesnt run");;

        return $check;
    }

    public function booknow($checkin, $checkout, $name, $phone, $roomname)
    {

        $sql = "SELECT * FROM rooms WHERE room_cat='$roomname' AND (room_id NOT IN (SELECT DISTINCT room_id
                FROM rooms WHERE checkin <= '$checkin' AND checkout >='$checkout'))";
        $check = mysqli_query($this->db, $sql)  or die(mysqli_connect_errno() . "Data herecannot inserted");;

        if (mysqli_num_rows($check) > 0) {
            $row = mysqli_fetch_array($check);
            $id = $row['room_id'];

            $sql2 = "UPDATE rooms  SET checkin='$checkin', checkout='$checkout', name='$name', phone='$phone', book='true' WHERE room_id=$id";
            $send = mysqli_query($this->db, $sql2);
            if ($send) {
                $result = "Your Room has been booked!!";
            } else {
                $result = "Sorry, Internel Error";
            }
        } else {
            $result = "No Room Is Available";
        }

        return $result;
    }


    //Find a single row in the database where id is provided.
    public static function find_by_id($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    //Find rows from the database provided the SQL statement.
    public static function find_by_sql($sql = "")
    {
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();
        while ($row = $db->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    //Instantiate all the attributes of the Class.
    private static function instantiate($record)
    {
        $object = new self;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    //Check if the attribute exists in the class.
    private function has_attribute($attribute)
    {
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars);
    }

    //Return an array of attribute keys and thier values.
    protected function attributes()
    {
        $attributes = array();
        foreach (self::$db_fields as $field):
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        endforeach;
        return $attributes;
    }

    //Prepare attributes for database.
    protected function sanitized_attributes()
    {
        global $db;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value):
            $clean_attributes[$key] = $db->escape_value($value);
        endforeach;
        return $clean_attributes;
    }

    //Save the changes.
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //Add  New Row to the database
    public function create()
    {
        global $db;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . self::$table_name . "(";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($db->query($sql)) {
            $this->id = $db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    //Update a row in the database.
    public function update()
    {
        global $db;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value):
            $attribute_pairs[] = "{$key}='{$value}'";
        endforeach;

        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= join(", ", array_values($attribute_pairs));
        $sql .= " WHERE id=" . $db->escape_value($this->id);
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
        //return true;
    }
}
