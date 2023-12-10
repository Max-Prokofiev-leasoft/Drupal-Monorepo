PLUGIN_NAME := bank_example-payment-plugin
GITHUB_REPO := Max-Prokofiev-leasoft/test1
TAG := v5.0.0
ZIP_FILENAME := ../../plugin/$(PLUGIN_NAME).zip
RELEASE_NAME := release BANKNAME  $(TAG)

release:
	@echo "Creating GitHub release for $(GITHUB_REPO)..."
	gh release create $(TAG) "$(ZIP_FILENAME)" -n "$(RELEASE_NAME)" -R $(GITHUB_REPO)
	@echo "GitHub release created for $(TAG) in repository $(GITHUB_REPO)"

.PHONY: release
