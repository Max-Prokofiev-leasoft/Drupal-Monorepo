#Releasing
.PHONY: release-all
release-all: release-ems release-xpate
	@echo "All releases completed."

.PHONY: release-ems
release-ems:
	@echo "Releasing EMS..."
	cd ems && cd script && make -f replacer && make -f builder && make -f release

.PHONY: release-xpate
release-xpate:
	@echo "Releasing XPATE"
	cd xpate && cd script && make -f replacer && make -f builder && make -f release

#Building
.PHONY: only-build-xpate
only-build-xpate:
	@echo "Build XPATE..."
	cd xpate && cd script && make -f replacer && make -f builder

.PHONY: only-build-ems
only-build-ems:
	@echo "Build EMS..."
	cd ems && cd script && make -f replacer && make -f builder
