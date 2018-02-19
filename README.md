AuditFields
- created_at
- updated_at
- deleted_at
- created_by
- updated_by
- deleted_by

Products
- id
- slug
- name
- note
- category_id
- image
- buy_price
- sale_price
* AuditFields

Categories
- id
- slug
- name
- image
- parent_id
* AuditFields

SettingTypes
- id
- code
- image
- name_en
- name_kh
- note
* AuditFields

SettingItems
- id
- type_id
- type_model
- code
- name_en
- name_kh
- value
- note
* AuditFields

Stocks
- id
- product_id
- quantity
- type (in / out)
* AuditFields

Order (=> Print Invoice)
- id
* AuditFields

OrderProduct
- order_id
- product_id
- price
- quantity



* User Role Permssion => Using Library


** NOTE
- slug for read on web and barcode reader

name -> unique() require
note -> nullable()->default(NULL)
id -> unsignedInteger()
price -> $table->decimal('price', 8, 2);
image -> $table->string('avatar')->default('default-name.jpg');
