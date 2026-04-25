# PHP 8.4 Compatibility - runkit7

**Repo:** `src/diepxuan/runkit7` (diepxuan/runkit7)
**Local path:** `/root/.openclaw/workspace/projects/ppa/src/diepxuan/runkit7`
**Branch:** `4.0.0a7` (PR #4)
**PR:** diepxuan/runkit7#4
**Ngay:** 2026-04-24
**Trang thai:** **HOAN THANH** - PHP 8.4 tests PASS

---

## Van de va Giai phap

### 1. doc_comment reference counting (offset-based storage change)

**Commit:** `67b9232`
**File:** `runkit.h`, `runkit_functions.c`

**Van de:** PHP 8.4 thay doi doc_comment storage tu pointer sang offset-based. `addref/delref` khong con hoat dong dung.

**Giai phap:**
- `runkit.h` - `php_runkit_modify_function_doc_comment()`: PHP 8.4+ dung `zend_string_copy/zend_string_release` thay vi `addref/delref`
- `runkit_functions.c:574` - `php_runkit_function_copy_ctor_same_type()`: PHP 8.4+ bo qua addref (da duoc copy dung bang `zend_string_copy` trong clone)
- `runkit_functions.c:678` - `php_runkit_function_clone()`: PHP 8.4+ goi `zend_string_copy` sau `memcpy` de tang refcount
- `runkit_functions.c:1148` - `php_runkit_generate_lambda_function()`: PHP 8.4+ dat `ZEND_ACC_RETURN_REFERENCE` flag
- `runkit_functions.c:1225` - `php_runkit_generate_lambda_method()`: PHP 8.4+ dat `ZEND_ACC_RETURN_REFERENCE` flag

### 2. E_STRICT deprecation trong test files

**Commits:** `5e68656`, `d6ea5c7`, `6cf500f`, `c914667`, `0d757a2`, `34abbf4`
**Files:** 17 test files

**Van de:** PHP 8.4 deprecate E_STRICT, cac test file su dung ham khong con phu hop se phat sinh warning.

**Giai phap:** Cap nhat `error_reporting()` trong 17 test files de suppression E_STRICT deprecation bang `@` operator:
- `tests/runkit_function_add_variation.phpt`
- `tests/runkit_function_add_return_reference.phpt`
- `tests/runkit_function_redefine_return_reference.phpt`
- `tests/runkit_method_add_return_reference.phpt`
- `tests/runkit_method_redefine_return_reference.phpt`
- `tests/runkit_function_add_closure.phpt`
- `tests/runkit_function_redefine_closure_static.phpt`
- `tests/runkit_function_redefine_closure.phpt`
- `tests/runkit_method_add_closure.phpt`
- `tests/runkit_method_redefine_closure.phpt`
- `tests/runkit_method_add_closure_php80.phpt`
- `tests/runkit_function_add_variadic.phpt`
- `tests/runkit_function_redefine_variadic.phpt`
- `tests/runkit_method_add_variadic.phpt`
- `tests/runkit_method_redefine_variadic.phpt`
- `tests/runkit_function_add_by_name_variadic.phpt`
- `tests/runkit_method_add_by_name_variadic.phpt`
- ...va cac test files khac

### 3. Superglobals test format change (packed array)

**Commit:** `70d8c12`
**Files:** `tests/runkit_superglobals_obj*.phpt`

**Van de:** PHP 8.4 thay doi format output cua superglobals (packed array).

**Giai phap:** Cap nhat EXPECTF voi `%A` wildcard de match format moi.

---

## Tong ket

**Source files da sua:** 2 (runkit.h, runkit_functions.c)
**Test files da sua:** 17+
**Tong so commits PHP 8.4:** 8

**Van de da giai quyet:**
1. PHP 8.4 doc_comment reference counting cho functions
2. PHP 8.4 E_STRICT deprecation trong test files
3. PHP 8.4 superglobals test format change (packed array)

**Tests bi skip tren PHP 8.4:** Khong co

**Known issues (XFAIL - expected):**
- runkit_constant_redefine_in_class.phpt
- runkit_constant_remove_from_class.phpt
- runkit_constant_remove_from_ns.phpt
- runkit_constants_manipulations_and_cache.phpt
