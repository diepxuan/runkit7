# Ke hoach sua loi PHP 8.4/8.5 - runkit7

**Repo:** `src/diepxuan/runkit7` (diepxuan/runkit7)
**Local path:** `/root/.openclaw/workspace/projects/ppa/src/diepxuan/runkit7`
**Branch:** `4.0.0a7` (PR #4)
**PR:** diepxuan/runkit7#4
**Ngay:** 2026-04-24
**CI run:** https://github.com/diepxuan/runkit7/actions/runs/24868044803

---

## Da sua duoc

### Commit `479da17` - release: 4.0.0a7

- Update package.xml: version 4.0.0a7, maintainer DiepXuan, date 2026-04-24
- Update runkit.h: PHP_RUNKIT7_VERSION 4.0.0a7
- Add changelog entry for 4.0.0a6
- Update .editorconfig: consistent style, fix typo
- Remove runkit7-fork-plan.md (moved to PPA docs)
- Update release.yml: remove version update step, fix quotes

### Commit `e013552` - fix: PHP 8.5 compatibility - const qualifier and return type cast

- **runkit_functions.c:367** - Them `const` vao `atomic_type` pointer
  - Fix: `discarded-qualifiers` error voi PHP 8.5 `ZEND_TYPE_LIST_FOREACH` macro

### Commit `67b9232` - fix: PHP 8.4 compatibility - doc_comment reference counting

- **runkit.h** - `php_runkit_modify_function_doc_comment()`: PHP 8.4+ dung `zend_string_copy/release` thay vi `addref/delref`
- **runkit_functions.c:574** - `php_runkit_function_copy_ctor_same_type()`: PHP 8.4+ bo qua addref
- **runkit_functions.c:678** - `php_runkit_function_clone()`: PHP 8.4+ explicit `zend_string_copy` sau memcpy
- **runkit_functions.c:1148** - `php_runkit_generate_lambda_function()`: PHP 8.4+ dat `ZEND_ACC_RETURN_REFERENCE`
- **runkit_functions.c:1225** - `php_runkit_generate_lambda_method()`: PHP 8.4+ dat `ZEND_ACC_RETURN_REFERENCE`

### Commit `f94e74f` - fix: PHP 8.5 - use proper return type for zend_register_constant

- **runkit_constants.c:411** - PHP 8.5+ dung `zend_constant *` return type, kiem tra NULL de tra ve SUCCESS/FAILURE
  - Fix: `pointer-to-int-cast` error voi `-Werror`

### Commit `5e68656` - fix: PHP 8.4 - handle E_STRICT deprecation in test files (method doc_comment)

- **tests/runkit_method_add_and_doc_comment.phpt** - Cap nhat error_reporting
- **tests/runkit_method_copy.phpt** - Cap nhat error_reporting
- **tests/runkit_method_copy_and_doc_comment.phpt** - Cap nhat error_reporting
- **tests/runkit_method_redefine_and_doc_comment.phpt** - Cap nhat error_reporting

### Commit `d6ea5c7` - fix: PHP 8.4 - handle E_STRICT deprecation in variadic test files

- **tests/runkit_function_variadic.phpt** - Cap nhat error_reporting
- **tests/runkit_function_variadic_strict.phpt** - Cap nhat error_reporting
- **tests/runkit_function_variadic_typed.phpt** - Cap nhat error_reporting
- **tests/runkit_method_variadic.phpt** - Cap nhat error_reporting
- **tests/runkit_method_variadic_strict.phpt** - Cap nhat error_reporting
- **tests/runkit_method_variadic_typed.phpt** - Cap nhat error_reporting

### Commit `6cf500f` - fix: PHP 8.4 - handle E_STRICT deprecation in return by reference test files

- **tests/runkit_functions_returning_by_reference.phpt** - Cap nhat error_reporting
- **tests/runkit_methods_returning_by_reference.phpt** - Cap nhat error_reporting

### Commit `70d8c12` - fix: PHP 8.4 - update superglobals test expectations

- **tests/runkit_superglobals_obj_php81.phpt** - Cap nhat `--EXPECTF--` voi wildcard cho array format
- **tests/runkit_superglobals_obj_alias_php81.phpt** - Cap nhat `--EXPECTF--` voi wildcard cho array format

### Commit `c914667` - fix: PHP 8.4 - handle E_STRICT deprecation in remaining test files

- **tests/bug57658.phpt** - Cap nhat error_reporting
- **tests/runkit_method_add_alias.phpt** - Cap nhat error_reporting
- **tests/runkit_method_remove.phpt** - Cap nhat error_reporting
- **tests/runkit_method_rename.phpt** - Cap nhat error_reporting
- **tests/runkit_superglobals.phpt** - Cap nhat error_reporting

---

## Tong ket

**Tong so commits:** 9
**Test files da sua:** 17
**Source files da sua:** 3 (runkit.h, runkit_functions.c, runkit_constants.c)

**Vấn đề đã giải quyết:**
1. PHP 8.5 compile error - const qualifier và return type cast
2. PHP 8.4 doc_comment reference counting cho functions
3. PHP 8.4 E_STRICT deprecation trong test files
4. PHP 8.4 superglobals test format change (packed array)

**Chờ CI run mới de xac nhan tat ca test pass.**
