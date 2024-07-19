<?php

$todo = new Todo();
$todo_list = $todo->getAll();

if (count($todo_list)) {

    foreach ($todo_list as $todo) {

        $checked = $todo['status'] ? 'checked' : '';
        $strike = $todo['status'] ? 'text-decoration-line-through' : '';
        $action = $todo['status'] ? 'unchecked' : 'checked';

        echo

        "<tr>
            <th>{$todo['id']}</th>
            <td>
                <div class='d-flex list-group-item'>
                    <a href='?$action={$todo['id']}' class='w-100 text-decoration-none text-dark'>
                        <input class='form-check-input me-1' type='checkbox' id='task-{$todo['id']}' $checked>
                        <label class='form-check-label $strike' for='task-{$todo['id']}'>{$todo['text']}</label>
                    </a>
                </div>
            </td>
            <td>
                <a href='?delete={$todo['id']}' type='button' class='p-2'><i class='fa-solid fa-trash text-danger'></i></a>      
            </td> 
        </tr>";
    }


} else {
    echo
    "<tr>
        <td colspan='3'>
            <h5 class='text-center'>Todo is empty</h5>
        </td>
    </tr>";
}




