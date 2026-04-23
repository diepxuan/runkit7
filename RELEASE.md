# Hướng Dẫn Release runkit7

## Tổng Quan

Quy trình release version mới cho diepxuan/runkit7 fork.

**Ví dụ:** Upgrade từ `4.0.0a6` → `4.0.0a7`

---

## Bước 1: Sync Upstream (Nếu cần)

```bash
# Fetch upstream changes
git fetch upstream

# Xem changes
git log HEAD..upstream/main --oneline

# Merge nếu có changes quan trọng
git merge upstream/main -m "[sync] Merge upstream runkit7/main"

# Resolve conflicts (nếu có)
# Test lại
make test
```

---

## Bước 2: Apply Patches (Nếu cần)

```bash
# Ví dụ: PHP 8.4 compatibility patch
patch -p1 < debian/runkit7-php84.patch
```

---

## Bước 3: Update Version

### 3.1 Update package.xml

```bash
# Thay version trong package.xml
sed -i 's|<release>4.0.0a6</release>|<release>4.0.0a7</release>|' package.xml
sed -i 's|<api_version>4.0.0a6</api_version>|<api_version>4.0.0a7</api_version>|' package.xml

# Update date
sed -i "s|<date>[^<]*</date>|<date>$(date +%Y-%m-%d)</date>|" package.xml

# Update notes
sed -i 's|<notes>.*</notes>|<notes>DiepXuan fork: PHP 8.4 compatibility, sync upstream changes.</notes>|' package.xml
```

### 3.2 Update runkit.h

```bash
# Thay version constant
sed -i 's|PHP_RUNKIT7_VERSION.*"4.0.0a6"|PHP_RUNKIT7_VERSION\t\t\t\t\t"4.0.0a7"|' runkit.h
```

### 3.3 Commit Changes

```bash
git add package.xml runkit.h
git commit -m "release: 4.0.0a7

- PHP 8.4 compatibility
- Sync upstream changes"
```

---

## Bước 4: Tạo Tag

```bash
# Tạo tag
git tag 4.0.0a7

# Push tag
git push origin 4.0.0a7
```

---

## Bước 5: Tạo Release

### Cách 1: Tạo release thủ công

```bash
gh release create 4.0.0a7 \
  --title "DiepXuan Fork 4.0.0a7" \
  --notes "DiepXuan fork of runkit7 with PHP 8.4+ compatibility.

## Changes

- PHP 8.4 compatibility patch
- Sync upstream changes
- Fix build issues

## PHP Versions Supported

- 7.2, 7.3, 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5

## Links

- Upstream: https://github.com/runkit7/runkit7
- Fork plan: runkit7-fork-plan.md"
```

### Cách 2: Tạo release từ GitHub UI

1. Vào https://github.com/diepxuan/runkit7/releases
2. Click "Draft a new release"
3. Chọn tag: `4.0.0a7`
4. Nhập title và notes
5. Click "Publish release"

---

## Bước 6: Build PECL Package (Tự động)

Workflow `.github/workflows/release.yml` sẽ tự động:

1. Trigger khi release published
2. Update package.xml version từ tag
3. Build: `pecl package` → `runkit7-4.0.0a7.tgz`
4. Upload .tgz vào release

**Không cần làm gì thêm.**

---

## Bước 7: Build Debian Package

### 7.1 Update PPA Build

```bash
# Trong src/php-ext
cd src/php-ext

# Update build.sh nếu cần
# (đã có git clone từ fork)
```

### 7.2 Build Package

```bash
# Trong php-runkit7 repo
cd src/diepxuan/php-runkit7

# Build
bash src/build.sh
```

### 7.3 Upload PPA

```bash
# Trong PPA repo
cd ppa
reprepro includedeb noble dists/*.deb
```

---

## Checklist

- [ ] Sync upstream (nếu cần)
- [ ] Apply patches (nếu cần)
- [ ] Update package.xml version
- [ ] Update runkit.h version
- [ ] Commit changes
- [ ] Tạo tag
- [ ] Push tag
- [ ] Tạo release
- [ ] Verify workflow build PECL package
- [ ] Build Debian package
- [ ] Upload PPA

---

## Rollback

Nếu release có vấn đề:

```bash
# Xóa release
gh release delete 4.0.0a7 --yes

# Xóa tag
git tag -d 4.0.0a7
git push --delete origin 4.0.0a7

# Revert commit
git revert HEAD
git push origin main
```

---

## Tài Liệu Tham Khảo

- [Fork Plan](runkit7-fork-plan.md) - Chi tiết phương án fork
- [Workflow](.github/workflows/release.yml) - Release workflow
- [Upstream](https://github.com/runkit7/runkit7) - runkit7 upstream
