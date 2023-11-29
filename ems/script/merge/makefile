PLUGIN_NAME := "BANKNAME-payment-plugin"

CORE_DIR := ../../../core
BANK_FUNC_DIR := ../../bank_func
BUILD_DIR := ./build
ZIP_FILENAME := ../../../plugin/$(PLUGIN_NAME).zip

merge_and_archive:
	@echo "Merging folders..."
	mkdir -p "$(BUILD_DIR)"
	rsync -av --exclude="build" "$(CORE_DIR)/" "$(BUILD_DIR)/"
	rsync -av --exclude="build" "$(BANK_FUNC_DIR)/" "$(BUILD_DIR)/"

	@echo "Creating ZIP archive..."
	cd "$(BUILD_DIR)" && zip -r "$(ZIP_FILENAME)" .
	@echo "ZIP archive created at $(ZIP_FILENAME)"



.PHONY: merge_and_archive
