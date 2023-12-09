PLUGIN_NAME := ems-payment-plugin
CORE_DIR := ../../../core
BANK_FUNC_DIR := ../../bank_func
BUILD_DIR := ./build
ZIP_FILENAME := ../../../plugin/$(PLUGIN_NAME).zip
ARCHIVE_DIR := $(BUILD_DIR)/$(PLUGIN_NAME)
REPLACEMENT := EMS

merge_and_archive:
	@echo "Merging folders..."
	mkdir -p "$(ARCHIVE_DIR)"

	@echo "Replacing text in files in bank_func and its subdirectories..."
	@echo "You can replace the finding word in 's/WORD/'"
	find "$(BANK_FUNC_DIR)" -type f -exec sed -i 's/BANKNAME/$(REPLACEMENT)/g' {} +

	rsync -av --exclude="build" "$(CORE_DIR)/" "$(ARCHIVE_DIR)/"
	rsync -av --exclude="build" "$(BANK_FUNC_DIR)/" "$(ARCHIVE_DIR)/"

	mkdir -p ../../plugin/

	@echo "Creating ZIP archive..."
	cd "$(BUILD_DIR)" && zip -r "$(ZIP_FILENAME)" "$(PLUGIN_NAME)/"
	@echo "ZIP archive created at $(ZIP_FILENAME)"

.PHONY: merge_and_archive
