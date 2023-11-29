PLUGIN_NAME := BANKNAME-payment-plugin

CORE_DIR := ../../../core
BANK_FUNC_DIR := ../../bank_func
BUILD_DIR := ./build
ZIP_FILENAME := ../../../plugin/$(PLUGIN_NAME).zip
ARCHIVE_DIR := $(BUILD_DIR)/$(PLUGIN_NAME)

merge_and_archive:
	@echo "Merging folders..."
	mkdir -p "$(ARCHIVE_DIR)"
	rsync -av --exclude="build" "$(CORE_DIR)/" "$(ARCHIVE_DIR)/"
	rsync -av --exclude="build" "$(BANK_FUNC_DIR)/" "$(ARCHIVE_DIR)/"

	@echo "Creating ZIP archive..."
	cd "$(BUILD_DIR)" && zip -r "$(ZIP_FILENAME)" "$(PLUGIN_NAME)/"
	@echo "ZIP archive created at $(ZIP_FILENAME)"

.PHONY: merge_and_archive
