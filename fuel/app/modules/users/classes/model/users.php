<?php
namespace Users;

class Model_Users extends \Model_Crud {
	protected static $_table_name = 'users';

/**
* ��������� ���������� � ������������ �� ������
* return array(...) ��� null ���� ������������ �� ������
*/
    public static function GetUserByToken($token){
		return Model_Users::find_one_by('token',$token); // ����� null ���� �� ������
	}
}