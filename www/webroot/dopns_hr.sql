/*
Navicat PGSQL Data Transfer

Source Server         : dopns.pakgon.com
Source Server Version : 80317
Source Host           : 203.113.25.92:5432
Source Database       : pdx
Source Schema         : dopns

Target Server Type    : PGSQL
Target Server Version : 80317
File Encoding         : 65001

Date: 2015-02-16 14:59:00
*/


-- ----------------------------
-- Table structure for acl_actions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."acl_actions";
CREATE TABLE "dopns"."acl_actions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(150),
"category" varchar(100),
"acltype" varchar(100),
"aclaccess" int2,
"description" varchar(150)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for acl_roles
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."acl_roles";
CREATE TABLE "dopns"."acl_roles" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(150),
"description" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for acl_roles_actions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."acl_roles_actions";
CREATE TABLE "dopns"."acl_roles_actions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"role_id" int8,
"action_id" int8,
"aclaccess" int2,
"access_override" int2,
"access" int2,
"list" int2,
"detail" int2,
"add" int2,
"edit" int2,
"delete" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for acl_roles_users
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."acl_roles_users";
CREATE TABLE "dopns"."acl_roles_users" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"role_id" int8,
"user_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."areas";
CREATE TABLE "dopns"."areas" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for barrack_organizations
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."barrack_organizations";
CREATE TABLE "dopns"."barrack_organizations" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"barrack_id" int8,
"organization_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for barracks
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."barracks";
CREATE TABLE "dopns"."barracks" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"address" varchar(255),
"district_id" int8,
"zone_id" int8,
"province_id" int8,
"country_id" int8,
"postal_code" varchar(10),
"telephone" varchar(15),
"area_id" int8,
"command_date" timestamp(6),
"command_date_str" varchar(20),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for bullet_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."bullet_types";
CREATE TABLE "dopns"."bullet_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"weapon_type_id" int8,
"attribute" varchar(255),
"capacity" varchar(255),
"weapon_id" int8,
"bullet_type" varchar(50)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."cities";
CREATE TABLE "dopns"."cities" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."configs";
CREATE TABLE "dopns"."configs" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"category" varchar(32),
"name" varchar(32),
"value" text
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for corps
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."corps";
CREATE TABLE "dopns"."corps" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(20),
"short_name" varchar(15),
"order_sort" int8,
"old_id" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."corps"."name" IS 'ชื่อเหล่า';
COMMENT ON COLUMN "dopns"."corps"."short_name" IS 'ตัวย่อ';

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."countries";
CREATE TABLE "dopns"."countries" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(100),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."districts";
CREATE TABLE "dopns"."districts" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(100),
"order_sort" int8,
"zone_id" int8,
"zipcode" varchar(5)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for division_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."division_types";
CREATE TABLE "dopns"."division_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"short_name" varchar(10),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for divisions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."divisions";
CREATE TABLE "dopns"."divisions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for employee_organizations
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."employee_organizations";
CREATE TABLE "dopns"."employee_organizations" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"description" text,
"organization_id" int8,
"organization_code" varchar(15),
"organization_name" varchar(50)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for employee_positions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."employee_positions";
CREATE TABLE "dopns"."employee_positions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(100),
"short_name" varchar(50),
"position_group_id" int8,
"description" text,
"code" varchar(5)
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."employee_positions"."short_name" IS 'Abbreviation';

-- ----------------------------
-- Table structure for employee_rates
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."employee_rates";
CREATE TABLE "dopns"."employee_rates" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"description" text,
"employee_organization_id" int8,
"employee_position_id" int8,
"number_employee" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for equipments
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."equipments";
CREATE TABLE "dopns"."equipments" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(255),
"description" text,
"tech_id" int8,
"command_code" varchar(10),
"command_name" text,
"order_sort" int8,
"image_name" varchar(255),
"image_type" varchar(120),
"image_size" int8,
"image_key" varchar(50) DEFAULT 'user_profile'::character varying,
"path" varchar(255),
"original_name" varchar(255)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for explanation_documents
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."explanation_documents";
CREATE TABLE "dopns"."explanation_documents" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"version" int2,
"content_type" varchar(100),
"path" varchar(255),
"original_name" varchar(255),
"file_size" int8,
"key" varchar(50),
"order_sort" int8,
"explanation_type" varchar(20),
"name" varchar(100)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_categories
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_categories";
CREATE TABLE "dopns"."model_categories" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_class
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_class";
CREATE TABLE "dopns"."model_class" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"short_name" varchar(10)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_divisions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_divisions";
CREATE TABLE "dopns"."model_divisions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(255),
"comment" text,
"model_id" int8,
"division_id" int8,
"mission_descriptions" text,
"model_division_type" varchar(10),
"quantity" int2,
"ref_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_documents
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_documents";
CREATE TABLE "dopns"."model_documents" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_id" int8,
"version" int2,
"content_type" varchar(100),
"path" varchar(255),
"original_name" varchar(255),
"file_size" int8,
"key" varchar(50),
"order_sort" int8,
"model_category_id" int8,
"name" varchar(100)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_equipments
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_equipments";
CREATE TABLE "dopns"."model_equipments" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_group_id" int8,
"model_id" int8,
"model_division_id" int8,
"model_position_id" int8,
"equipment_id" int8,
"equipment_code" varchar(10),
"rate_full" int2 DEFAULT 0,
"rate_decrease_1" int2 DEFAULT 0,
"rate_decrease_2" int2 DEFAULT 0,
"rate_decrease_3" int2 DEFAULT 0,
"rate_structure" int2 DEFAULT 0,
"comment" text,
"order_sort" int8,
"equipment_name" varchar(255),
"rate_div_9" int2,
"tech_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_group_equipments
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_group_equipments";
CREATE TABLE "dopns"."model_group_equipments" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_group_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_group_users
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_group_users";
CREATE TABLE "dopns"."model_group_users" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_group_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_groups
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_groups";
CREATE TABLE "dopns"."model_groups" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_id" int8,
"order_sort" int8,
"name" varchar(200),
"quantity" int2,
"comment" text,
"model_parent_id" int8,
"code" varchar(20)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_levels
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_levels";
CREATE TABLE "dopns"."model_levels" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(15),
"name" varchar(100),
"short_name" varchar(50),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_positions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_positions";
CREATE TABLE "dopns"."model_positions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(100),
"comment" text,
"model_id" int8,
"model_division_id" int8,
"model_subdivision_id" int8,
"position_id" int8,
"short_name" varchar(50),
"full_name" varchar(100),
"description" text,
"ref_id" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."model_positions"."short_name" IS 'Abbreviation';

-- ----------------------------
-- Table structure for model_positions_copy
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_positions_copy";
CREATE TABLE "dopns"."model_positions_copy" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(100),
"comment" text,
"model_id" int8,
"model_division_id" int8,
"model_subdivision_id" int8,
"position_id" int8,
"short_name" varchar(50),
"full_name" varchar(100),
"description" text,
"ref_id" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."model_positions_copy"."short_name" IS 'Abbreviation';

-- ----------------------------
-- Table structure for model_properties
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_properties";
CREATE TABLE "dopns"."model_properties" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(100),
"model_id" int8,
"model_division_id" int8,
"model_position_id" int8,
"rate_full" int2,
"rate_decrease_1" int2,
"rate_decrease_2" int2,
"rate_decrease_3" int2,
"rate_structure" int2,
"comment" text,
"weapon_id" int8,
"weapon_name" varchar(10),
"rank_id" int8,
"corp_id" int8,
"mos" varchar(10),
"mission_descriptions" text,
"model_subdivision_id" int8,
"ref_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_statuses
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_statuses";
CREATE TABLE "dopns"."model_statuses" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(20),
"order_sort" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."model_statuses"."name" IS 'ชื่อยศ';

-- ----------------------------
-- Table structure for model_structures
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_structures";
CREATE TABLE "dopns"."model_structures" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_id" int8,
"version" int2,
"content_type" varchar(100),
"path" varchar(255),
"original_name" varchar(255),
"file_size" int8,
"key" varchar(50),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_subdivisions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_subdivisions";
CREATE TABLE "dopns"."model_subdivisions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(100),
"comment" text,
"model_id" int8,
"model_division_id" int8,
"subdivision_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for model_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."model_types";
CREATE TABLE "dopns"."model_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"short_name" varchar(10),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for models
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."models";
CREATE TABLE "dopns"."models" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"descriptions" text,
"model_category_id" int8,
"parent_id" int8,
"parent_code" varchar(10),
"order_sort" int8,
"is_draft" varchar(1) DEFAULT 'Y'::bpchar,
"is_approved" varchar(1) DEFAULT 'N'::bpchar,
"is_locked" varchar(1) DEFAULT 'N'::bpchar,
"user_locked_id" int8,
"organization_id" int8,
"comment_user" text,
"comment_equipment" text,
"command_user" varchar(50),
"command_user_date" timestamp(6),
"command_equipment" varchar(50),
"command_equipment_date" timestamp(6),
"approved_user" varchar(1) DEFAULT 'N'::bpchar,
"approved_date_user" timestamp(6),
"approved_equipment" varchar(1) DEFAULT 'N'::bpchar,
"approved_date_equipment" timestamp(6),
"model_date" timestamp(6),
"model_status_id" int8,
"short_name" varchar(100),
"full_name" varchar(100),
"model" varchar(10),
"comment" text,
"model_type_id" int8,
"model_class_id" int8,
"is_group" char(1) DEFAULT 'N'::bpchar,
"is_approved_user" varchar(1) DEFAULT 'N'::bpchar,
"is_approved_equipment" varchar(1) DEFAULT 'N'::bpchar,
"unit_id" int8,
"ref_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for months
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."months";
CREATE TABLE "dopns"."months" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"short_name" varchar(50),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_class
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_class";
CREATE TABLE "dopns"."organization_class" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_informations
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_informations";
CREATE TABLE "dopns"."organization_informations" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"organization_id" int8,
"location" text,
"unit" varchar(100),
"area_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_levels
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_levels";
CREATE TABLE "dopns"."organization_levels" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_model_equipments
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_model_equipments";
CREATE TABLE "dopns"."organization_model_equipments" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"model_id" int8,
"order_sort" int8,
"version" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_model_users
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_model_users";
CREATE TABLE "dopns"."organization_model_users" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"organization_id" int8,
"user_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_model_versions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_model_versions";
CREATE TABLE "dopns"."organization_model_versions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"organization_id" int8,
"model_id" int8,
"version" int2,
"organization_model_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_models
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_models";
CREATE TABLE "dopns"."organization_models" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"organization_id" int8,
"model_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_sciences
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_sciences";
CREATE TABLE "dopns"."organization_sciences" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"organization_id" int8,
"organization_group_id" int8,
"short_name" varchar(100),
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."organization_sciences"."organization_id" IS 'Abbreviation';

-- ----------------------------
-- Table structure for organization_sizes
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_sizes";
CREATE TABLE "dopns"."organization_sizes" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_structures
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_structures";
CREATE TABLE "dopns"."organization_structures" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(100),
"order_sort" int8,
"organization_type_id" int8,
"organization_id" int8,
"organization_level" int2,
"level_0" int2,
"level_1" int2,
"level_2" int2,
"level_3" int2,
"level_4" int2,
"level_5" int2,
"level_6" int2,
"level_7" int2,
"level_8" int2,
"max_level" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_targets
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_targets";
CREATE TABLE "dopns"."organization_targets" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organization_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organization_types";
CREATE TABLE "dopns"."organization_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"descriptions" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for organizations
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organizations";
CREATE TABLE "dopns"."organizations" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"short_name" varchar(50),
"organization_level_id" int8,
"organization_type_id" int8,
"parent_id" int8,
"parent_code" varchar(20),
"order_sort" int8,
"barrack_id" int8,
"model" varchar(10),
"province_id" int8,
"zone_id" int8,
"district_id" int8,
"model_id" int8,
"establish_date" timestamp(6),
"reorganize_date" timestamp(6),
"command" varchar(50),
"command_date" timestamp(6),
"description" text,
"organization_class_id" int8,
"organization_target_id" int8,
"corp_id" int8,
"rate_property" varchar(20),
"rate_equipment" varchar(20),
"descriptions" text,
"address" varchar(100),
"latitude" varchar(20),
"longitude" varchar(20),
"organization_size_id" int8,
"parent_organization_type_1_id" int8,
"parent_organization_type_2_id" int8,
"parent_organization_type_3_id" int8,
"parent_organization_type_4_id" int8,
"parent_organization_type_5_id" int8,
"parent_organization_type_6_id" int8,
"parent_organization_type_7_id" int8,
"parent_organization_type_8_id" int8,
"parent_organization_type_9_id" int8,
"order_sort_type_1" int8,
"order_sort_type_2" int8,
"order_sort_type_3" int8,
"order_sort_type_4" int8,
"order_sort_type_5" int8,
"order_sort_type_6" int8,
"order_sort_type_7" int8,
"order_sort_type_8" int8,
"order_sort_type_9" int8,
"id_new" int8,
"level" int2,
"location" text
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."organizations"."name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations"."short_name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations"."organization_level_id" IS 'Abbreviation';

-- ----------------------------
-- Table structure for organizations_copy
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organizations_copy";
CREATE TABLE "dopns"."organizations_copy" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"short_name" varchar(50),
"organization_level_id" int8,
"organization_type_id" int8,
"parent_id" int8,
"parent_code" varchar(20),
"order_sort" int8,
"barrack_id" int8,
"model" varchar(10),
"province_id" int8,
"zone_id" int8,
"district_id" int8,
"model_id" int8,
"establish_date" timestamp(6),
"reorganize_date" timestamp(6),
"command" varchar(50),
"command_date" timestamp(6),
"description" text,
"organization_class_id" int8,
"organization_target_id" int8,
"corp_id" int8,
"rate_property" varchar(20),
"rate_equipment" varchar(20),
"descriptions" text,
"address" varchar(100),
"latitude" varchar(20),
"longitude" varchar(20),
"organization_size_id" int8,
"parent_organization_type_1_id" int8,
"parent_organization_type_2_id" int8,
"parent_organization_type_3_id" int8,
"parent_organization_type_4_id" int8,
"parent_organization_type_5_id" int8,
"parent_organization_type_6_id" int8,
"parent_organization_type_7_id" int8,
"parent_organization_type_8_id" int8,
"parent_organization_type_9_id" int8,
"order_sort_type_1" int8,
"order_sort_type_2" int8,
"order_sort_type_3" int8,
"order_sort_type_4" int8,
"order_sort_type_5" int8,
"order_sort_type_6" int8,
"order_sort_type_7" int8,
"order_sort_type_8" int8,
"order_sort_type_9" int8,
"id_new" int8,
"level" int2,
"location" text
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."organizations_copy"."name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations_copy"."short_name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations_copy"."organization_level_id" IS 'Abbreviation';

-- ----------------------------
-- Table structure for organizations_org
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."organizations_org";
CREATE TABLE "dopns"."organizations_org" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(20),
"name" varchar(100),
"short_name" varchar(50),
"organization_level_id" int8,
"organization_type_id" int8,
"parent_id" int8,
"parent_code" varchar(20),
"order_sort" int8,
"barrack_id" int8,
"model" varchar(10),
"province_id" int8,
"zone_id" int8,
"district_id" int8,
"model_id" int8,
"establish_date" timestamp(6),
"reorganize_date" timestamp(6),
"command" varchar(50),
"command_date" timestamp(6),
"description" text,
"organization_class_id" int8,
"organization_target_id" int8,
"corp_id" int8,
"rate_property" varchar(20),
"rate_equipment" varchar(20),
"descriptions" text,
"address" varchar(100),
"latitude" varchar(20),
"longitude" varchar(20),
"organization_size_id" int8,
"parent_organization_type_1_id" int8,
"parent_organization_type_2_id" int8,
"parent_organization_type_3_id" int8,
"parent_organization_type_4_id" int8,
"parent_organization_type_5_id" int8,
"parent_organization_type_6_id" int8,
"parent_organization_type_7_id" int8,
"parent_organization_type_8_id" int8,
"parent_organization_type_9_id" int8,
"order_sort_type_1" int8,
"order_sort_type_2" int8,
"order_sort_type_3" int8,
"order_sort_type_4" int8,
"order_sort_type_5" int8,
"order_sort_type_6" int8,
"order_sort_type_7" int8,
"order_sort_type_8" int8,
"order_sort_type_9" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."organizations_org"."name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations_org"."short_name" IS 'Abbreviation';
COMMENT ON COLUMN "dopns"."organizations_org"."organization_level_id" IS 'Abbreviation';

-- ----------------------------
-- Table structure for position_groups
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."position_groups";
CREATE TABLE "dopns"."position_groups" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"order_sort" int8,
"name" varchar(200),
"code" varchar(5),
"description" text
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."positions";
CREATE TABLE "dopns"."positions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"order_sort" int8,
"mis_id" int8,
"mis_code" varchar(20),
"mis_name" varchar(255),
"mis_is_verifily" varchar(1),
"ref_mis_id" int8,
"id_bak" int8,
"source" varchar(10),
"ref_mis_id_2" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."provinces";
CREATE TABLE "dopns"."provinces" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(100),
"order_sort" int8,
"country_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."ranks";
CREATE TABLE "dopns"."ranks" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(20),
"short_name" varchar(15),
"order_sort" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."ranks"."name" IS 'ชื่อยศ';
COMMENT ON COLUMN "dopns"."ranks"."short_name" IS 'ตัวย่อ';

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."roles";
CREATE TABLE "dopns"."roles" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" text,
"description" text,
"modules" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for roles_modules
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."roles_modules";
CREATE TABLE "dopns"."roles_modules" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"role_id" int8,
"module_id" int8,
"allow" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for roles_users
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."roles_users";
CREATE TABLE "dopns"."roles_users" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"role_id" int8,
"user_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for subdivisions
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."subdivisions";
CREATE TABLE "dopns"."subdivisions" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"order_sort" int8,
"ref_mis_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for techs
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."techs";
CREATE TABLE "dopns"."techs" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(100),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for trackers
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."trackers";
CREATE TABLE "dopns"."trackers" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"monitor_id" int8,
"user_id" int8,
"module_name" varchar(255),
"item_id" int8,
"item_summary" varchar(255),
"action" varchar(255),
"session_id" int8,
"visible" int2,
"value" text,
"ip" varchar(20),
"request_pass" text,
"request_data" text
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for unit_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."unit_types";
CREATE TABLE "dopns"."unit_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(50),
"order_sort" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."unit_types"."name" IS 'ชื่อยศ';

-- ----------------------------
-- Table structure for units
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."units";
CREATE TABLE "dopns"."units" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" varchar(50),
"short_name" varchar(15),
"order_sort" int8,
"unit_type_id" int2,
"organization_id" int8
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "dopns"."units"."name" IS 'ชื่อยศ';
COMMENT ON COLUMN "dopns"."units"."short_name" IS 'ตัวย่อ';

-- ----------------------------
-- Table structure for user_profiles
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."user_profiles";
CREATE TABLE "dopns"."user_profiles" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"user_id" int8,
"name" varchar(50),
"surname" varchar(50),
"identification_code" varchar(15),
"image_name" varchar(255),
"image_type" varchar(120),
"image_size" int8,
"image_key" varchar(50) DEFAULT 'user_profile'::character varying,
"position" varchar(50),
"telephone" varchar(20)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."users";
CREATE TABLE "dopns"."users" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"username" varchar(50),
"password" varchar(255),
"name" varchar(50),
"surname" varchar(50),
"unit_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for weapon_bullet_documents
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."weapon_bullet_documents";
CREATE TABLE "dopns"."weapon_bullet_documents" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"weapon_bullet_id" int8,
"content_type" varchar(100),
"path" varchar(255),
"original_name" varchar(255),
"file_size" int8,
"key" varchar(50),
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for weapon_bullets
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."weapon_bullets";
CREATE TABLE "dopns"."weapon_bullets" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"weapon_type_id" int8,
"attribute" varchar(255),
"capacity" varchar(255),
"weapon_id" int8,
"bullet_type" varchar(50)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for weapon_relations
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."weapon_relations";
CREATE TABLE "dopns"."weapon_relations" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"weapon_id" int8,
"command_code" varchar(10),
"command_name" text,
"order_sort" int8,
"image_name" varchar(255),
"image_type" varchar(120),
"image_size" int8,
"image_key" varchar(50) DEFAULT 'user_profile'::character varying,
"capacity" varchar(255)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for weapon_types
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."weapon_types";
CREATE TABLE "dopns"."weapon_types" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"name" text,
"order_sort" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for weapons
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."weapons";
CREATE TABLE "dopns"."weapons" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" text,
"description" text,
"weapon_type_id" int8,
"number_shot" int2,
"order_sort" int8,
"parent_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for zones
-- ----------------------------
DROP TABLE IF EXISTS "dopns"."zones";
CREATE TABLE "dopns"."zones" (
"id" int8 NOT NULL,
"created" timestamp(6),
"created_by" int8,
"updated" timestamp(6),
"updated_by" int8,
"deleted" char(1) DEFAULT 'N'::bpchar,
"deleted_by" int8,
"code" varchar(10),
"name" varchar(100),
"order_sort" int8,
"province_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table acl_actions
-- ----------------------------
ALTER TABLE "dopns"."acl_actions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table acl_roles
-- ----------------------------
ALTER TABLE "dopns"."acl_roles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table acl_roles_actions
-- ----------------------------
ALTER TABLE "dopns"."acl_roles_actions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table acl_roles_users
-- ----------------------------
ALTER TABLE "dopns"."acl_roles_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table areas
-- ----------------------------
ALTER TABLE "dopns"."areas" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table barrack_organizations
-- ----------------------------
ALTER TABLE "dopns"."barrack_organizations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table barracks
-- ----------------------------
ALTER TABLE "dopns"."barracks" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table bullet_types
-- ----------------------------
ALTER TABLE "dopns"."bullet_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table cities
-- ----------------------------
ALTER TABLE "dopns"."cities" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table configs
-- ----------------------------
ALTER TABLE "dopns"."configs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table corps
-- ----------------------------
ALTER TABLE "dopns"."corps" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table countries
-- ----------------------------
ALTER TABLE "dopns"."countries" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table districts
-- ----------------------------
ALTER TABLE "dopns"."districts" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table division_types
-- ----------------------------
ALTER TABLE "dopns"."division_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table divisions
-- ----------------------------
ALTER TABLE "dopns"."divisions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table employee_organizations
-- ----------------------------
ALTER TABLE "dopns"."employee_organizations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table employee_positions
-- ----------------------------
ALTER TABLE "dopns"."employee_positions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table employee_rates
-- ----------------------------
ALTER TABLE "dopns"."employee_rates" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table equipments
-- ----------------------------
ALTER TABLE "dopns"."equipments" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table explanation_documents
-- ----------------------------
ALTER TABLE "dopns"."explanation_documents" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_categories
-- ----------------------------
ALTER TABLE "dopns"."model_categories" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_class
-- ----------------------------
ALTER TABLE "dopns"."model_class" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_divisions
-- ----------------------------
ALTER TABLE "dopns"."model_divisions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_documents
-- ----------------------------
ALTER TABLE "dopns"."model_documents" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_equipments
-- ----------------------------
ALTER TABLE "dopns"."model_equipments" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_group_equipments
-- ----------------------------
ALTER TABLE "dopns"."model_group_equipments" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_group_users
-- ----------------------------
ALTER TABLE "dopns"."model_group_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_groups
-- ----------------------------
ALTER TABLE "dopns"."model_groups" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_levels
-- ----------------------------
ALTER TABLE "dopns"."model_levels" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_positions
-- ----------------------------
ALTER TABLE "dopns"."model_positions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_positions_copy
-- ----------------------------
ALTER TABLE "dopns"."model_positions_copy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_properties
-- ----------------------------
ALTER TABLE "dopns"."model_properties" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_statuses
-- ----------------------------
ALTER TABLE "dopns"."model_statuses" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_structures
-- ----------------------------
ALTER TABLE "dopns"."model_structures" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_subdivisions
-- ----------------------------
ALTER TABLE "dopns"."model_subdivisions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_types
-- ----------------------------
ALTER TABLE "dopns"."model_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table models
-- ----------------------------
ALTER TABLE "dopns"."models" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table months
-- ----------------------------
ALTER TABLE "dopns"."months" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_class
-- ----------------------------
ALTER TABLE "dopns"."organization_class" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_informations
-- ----------------------------
ALTER TABLE "dopns"."organization_informations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_levels
-- ----------------------------
ALTER TABLE "dopns"."organization_levels" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_model_equipments
-- ----------------------------
ALTER TABLE "dopns"."organization_model_equipments" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_model_users
-- ----------------------------
ALTER TABLE "dopns"."organization_model_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_model_versions
-- ----------------------------
ALTER TABLE "dopns"."organization_model_versions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_models
-- ----------------------------
ALTER TABLE "dopns"."organization_models" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_sciences
-- ----------------------------
ALTER TABLE "dopns"."organization_sciences" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_sizes
-- ----------------------------
ALTER TABLE "dopns"."organization_sizes" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_structures
-- ----------------------------
ALTER TABLE "dopns"."organization_structures" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_targets
-- ----------------------------
ALTER TABLE "dopns"."organization_targets" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organization_types
-- ----------------------------
ALTER TABLE "dopns"."organization_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organizations
-- ----------------------------
ALTER TABLE "dopns"."organizations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organizations_copy
-- ----------------------------
ALTER TABLE "dopns"."organizations_copy" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table organizations_org
-- ----------------------------
ALTER TABLE "dopns"."organizations_org" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table position_groups
-- ----------------------------
ALTER TABLE "dopns"."position_groups" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table positions
-- ----------------------------
ALTER TABLE "dopns"."positions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table provinces
-- ----------------------------
ALTER TABLE "dopns"."provinces" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ranks
-- ----------------------------
ALTER TABLE "dopns"."ranks" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table roles
-- ----------------------------
ALTER TABLE "dopns"."roles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table roles_modules
-- ----------------------------
ALTER TABLE "dopns"."roles_modules" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table roles_users
-- ----------------------------
ALTER TABLE "dopns"."roles_users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table subdivisions
-- ----------------------------
ALTER TABLE "dopns"."subdivisions" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table techs
-- ----------------------------
ALTER TABLE "dopns"."techs" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table trackers
-- ----------------------------
ALTER TABLE "dopns"."trackers" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table unit_types
-- ----------------------------
ALTER TABLE "dopns"."unit_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table units
-- ----------------------------
ALTER TABLE "dopns"."units" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table user_profiles
-- ----------------------------
ALTER TABLE "dopns"."user_profiles" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "dopns"."users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table weapon_bullet_documents
-- ----------------------------
ALTER TABLE "dopns"."weapon_bullet_documents" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table weapon_bullets
-- ----------------------------
ALTER TABLE "dopns"."weapon_bullets" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table weapon_relations
-- ----------------------------
ALTER TABLE "dopns"."weapon_relations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table weapon_types
-- ----------------------------
ALTER TABLE "dopns"."weapon_types" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table weapons
-- ----------------------------
ALTER TABLE "dopns"."weapons" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table zones
-- ----------------------------
ALTER TABLE "dopns"."zones" ADD PRIMARY KEY ("id");
